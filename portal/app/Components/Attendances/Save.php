<?php

namespace App\Components\Attendances;

use Bastinald\Ux\Traits\WithModel;
use App\Models\Attendance;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Save extends Component
{
    use WithModel;

    public $attendance;

    public function mount(Attendance $attendance = null)
    {
        $this->attendance = $attendance;

        $this->setModel($attendance->toArray());
    }

    public function render()
    {
        return view('attendances.save',[
        'attendances' => $this->query()->paginate(),
    ]);
    }

    public function rules()
    {
        return [
            'name' => ['required'],
        ];
    }

    // public function getParent()
    // {
    //     $sect=User::all()->with('user')->where('role','student')->where('school_id',Auth::user()->school_id)
    //     ->pluck('id', 'name');    
    //     dd($sect);    
    //     return $sect;
    // }

    public function getUser()
    {
        $sect=User::with('attendance');
        $sect->where('role','student');
        $sect->where('school_id',Auth::user()->school_id);
        // $sect->pluck('id', 'name');    
        // dd($sect);    
        return $sect;
    }

    public function query()
    {
        $query = User::query()->with('attendance');

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

    public function save()
    {
        $this->validateModel();

        $this->attendance->fill($this->getModel())->save();

        $this->emit('hideModal');
        $this->emit('$refresh');
    }
}
