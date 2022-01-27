<?php

namespace App\Components\Results;

use Bastinald\Ux\Traits\WithModel;
use App\Models\Result;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Section;
 
class Save extends Component
{
    use WithModel;

    public $user;
    public $result;

    public function mount(Result $result = null)
    {
        $this->result = $result;

        $this->setModel($result->toArray());
    }

    public function getStudent()
    {
        $sect=User::all()->where('role','student')
        ->where('school_id',Auth::user()->school_id)
        ->pluck('id');        
        return $sect;
    }

    public function render()
    {
        return view('results.save');
    }

    public function rules()
    {
        return [
            'student_id' => ['required'],
        ];
    }

    public function save()
    {
        $this->validateModel();

        $this->result->fill($this->getModel())->save();

        $this->emit('hideModal');
        $this->emit('$refresh');
    }
}
