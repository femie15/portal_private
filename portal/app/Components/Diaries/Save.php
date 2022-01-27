<?php

namespace App\Components\Diaries;

use Bastinald\Ux\Traits\WithModel;
use App\Models\Diary;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
 
class Save extends Component
{
    use WithModel;

    public $diary;

    public function mount(Diary $diary = null)
    {
        $this->diary = $diary;

        $this->setModel($diary->toArray());
    }

    public function render()
    {
        return view('diaries.save');
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

        $this->setModel('user_id',Auth::user()->id);
        $this->setModel('school_id',Auth::user()->school_id);
        $this->diary->fill($this->getModel())->save();

        $this->emit('hideModal');
        $this->emit('$refresh');
    }
}
