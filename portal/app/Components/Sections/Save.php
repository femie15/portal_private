<?php

namespace App\Components\Sections;

use Bastinald\Ux\Traits\WithModel;
use App\Models\Section;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Save extends Component
{
    use WithModel;

    public $section;

    public function mount(Section $section = null)
    {
        $this->section = $section;

        $this->setModel($section->toArray());
    }

    public function render()
    {
        return view('sections.save',[
            'getClass'=> $this->getClass(),
        ]);
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
        $this->section->fill($this->getModel())->save();

        $this->emit('hideModal');
        $this->emit('$refresh');
    }
 
    public static function getClass()
    {
        $titles = DB::table('classeds')
        ->where('name','!=','graduate')
        ->where('school_id',Auth::user()->school_id)
        ->where('deleted_at',NULL)
        ->pluck('id', 'name');  

        return $titles;
    }
}
 