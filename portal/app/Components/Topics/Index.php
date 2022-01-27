<?php

namespace App\Components\Topics;

use Bastinald\Ux\Traits\WithModel;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Livewire\Component; 
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithModel, WithPagination;

    protected $listeners = ['$refresh'];

    public function route()
    {
        return Route::get('topics', static::class)
            ->name('topics')
            ->middleware('auth');
    }

    public function mount()
    {
        $this->setModel([
            'sort' => 'Name',
            'sorts' => ['Name', 'Newest', 'Oldest'],
            'filter' => 'All',
            'filters' => ['All', '100th'],
        ]);
    }

    public function getClass()
    {
        $titles = DB::table('classeds')
        ->where('name','!=','graduate')
        ->where('school_id',Auth::user()->school_id)
        ->pluck('id', 'name');
        return $titles;
    } 

    public function getSub()
    {
        $titles = DB::table('subjects')
        ->where('school_id',Auth::user()->school_id)
        ->pluck('id', 'name');
        return $titles;
    } 

    public function diary($tip='')
    {
        $titles = DB::table('diaries')
        ->where('school_id',Auth::user()->school_id)
        ->where('topic_id',$tip)
        ->pluck('id');

        if (count($titles)>0) {            
            return $titles;
        }else {            
            return 1;
        }
    }

    public function render()
    {
        return view('topics.index', [
            'topics' => $this->query()->paginate(),
            'getClass' => $this->getClass(),
            'getSub' => $this->getSub(),
        ]);
    }

    public function query()
    {
        $query = Topic::query();

        if ($search = $this->getModel('search')) {
            $query->where(function (Builder $query) use ($search) {
                $query->orWhere('id', 'like', '%' . $search . '%');
                $query->orWhere('name', 'like', '%' . $search . '%');
            });
        }

        switch ($this->getModel('sort')) {
            case 'Name': $query->orderBy('name'); break;
            case 'Newest': $query->orderByDesc('created_at'); break;
            case 'Oldest': $query->orderBy('created_at'); break;
        }

        switch ($this->getModel('filter')) {
            case 'All': break;
            case '100th': $query->where('id', 100); break;
        }

        return $query;
    }

    public function delete(Topic $topic)
    {
        $topic->delete();
    }
}
