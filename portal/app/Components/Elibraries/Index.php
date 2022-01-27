<?php

namespace App\Components\Elibraries;

use Bastinald\Ux\Traits\WithModel;
use App\Models\Elibrary;
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
        return Route::get('elibrary', static::class)
            ->name('elibrary')
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

    public function render()
    {
        return view('elibraries.index', [
            'elibraries' => $this->query()->paginate(),
            'elibrariespq' => $this->querypq()->paginate(),
        ]);
    }

    public function query()
    {
        $query = Elibrary::query();
        // $query()->where('school_id',Auth::user()->school_id);

        if ($search = $this->getModel('search')) {
            $query->where(function (Builder $query) use ($search) {
                // $query->orWhere('id', 'like', '%' . $search . '%');
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

        return $query->where('type','!=','pq')->orwhere('type',NULL);
    }

    public function querypq()
    {
        $querypq = Elibrary::query()->where('school_id',Auth::user()->school_id)->where('type','pq');

        if ($search = $this->getModel('search')) {
            $querypq->where(function (Builder $querypq) use ($search) {
                $querypq->orWhere('id', 'like', '%' . $search . '%');
                $querypq->orWhere('name', 'like', '%' . $search . '%');
            });
        }

        switch ($this->getModel('sort')) {
            case 'Name': $querypq->orderBy('name'); break;
            case 'Newest': $querypq->orderByDesc('created_at'); break;
            case 'Oldest': $querypq->orderBy('created_at'); break;
        }

        switch ($this->getModel('filter')) {
            case 'All': break;
            case '100th': $querypq->where('id', 100); break;
        }

        return $querypq;
    }

    public function delete(Elibrary $elibrary)
    {
        $elibrary->delete();
    }
}
