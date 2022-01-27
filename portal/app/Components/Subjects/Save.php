<?php

namespace App\Components\Subjects;

use Bastinald\Ux\Traits\WithModel;
use App\Models\Subject;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Save extends Component
{
    use WithModel;

    public $subject;
 
    public function mount(Subject $subject = null)
    {
        $this->subject = $subject;

        $this->setModel($subject->toArray());
    }

    public function render()
    {
        return view('subjects.save',[
            'getSubject'=> $this->getSubject(),
        ]);
    }

    public static function getSubject()
    {
        $titles = DB::table('subjects')
        ->where('name','!=','graduate')
        ->orderby('name')
        ->pluck('id', 'name');  

        return $titles;
    }

    public function rules()
    {
        return [
            'name' => ['required'],
        ];
    }
 
    public function save()
    {
        $this->validateModel();

        $this->setModel('school_id',Auth::user()->school_id);
        $this->subject->fill($this->getModel())->save();

        $this->emit('hideModal');
        $this->emit('$refresh');
    }
}
