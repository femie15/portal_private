<?php

namespace App\Components\Messages;

use Bastinald\Ux\Traits\WithModel;
use App\Models\Message;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Index extends Component
{ 
    use WithModel, WithPagination;

    protected $listeners = ['$refresh', 'msg' => 'gatMessages'];

    // public function gatMessages($mid){
    //     $this->emit('showModal', 'messages.save',$mid);
    // } 
    
    public function route()
    {
        return Route::get('messages', static::class)
            ->name('messages')
            ->middleware('auth');
    }

    public function mount()
    {
        $this->setModel([
            'sort' => 'Name',
            'sorts' => ['Name', 'Newest', 'Oldest'],
            'filter' => 'Select Participant',
            'filters' => ['Parents', 'Teachers', 'Students'],
        ]);
    }

    public function render()
    {
        // dd($this->query()->paginate());
        return view('messages.index', [
            'messages' => $this->query()->paginate(),
            'select' => $this->getModel('filter'),
        ]);
    }

    public function query()
    {       
        $query = User::query()->where('school_id', Auth::user()->school_id);

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
            case 'Select Participant': $query->where('role', 'none'); break;
            case 'Parents': $query->where('role', 'parent'); break;
            case 'Teachers': $query->where('role', 'teacher'); break;
            case 'Students': $query->where('role', 'student'); break;
        }
        

        return $query;
    }

    public function delete(Message $message)
    {
        $message->delete();
    }
}
