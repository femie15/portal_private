<?php

namespace App\Components\Subjects;

use Bastinald\Ux\Traits\WithModel;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithModel, WithPagination;

    protected $listeners = ['$refresh'];

    public function route()
    {
        return Route::get('subjects', static::class)
            ->name('subjects')
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
        return view('subjects.index', [
            'subjects' => $this->query()->paginate(),
        ]);
    }

    public function query()
    {
        $query = Subject::query()->where('school_id',Auth::user()->school_id);

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

        return $query->orderBy('name');
    }

    public function delete(Subject $subject)
    {
        $subject->delete();
    }
}
