<?php

namespace DummyComponentNamespace;

use Bastinald\Ux\Traits\WithModel;
use DummyModelNamespace\DummyModelClass;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Save extends Component
{
    use WithModel;

    public $dummyModelVariable;

    public function mount(DummyModelClass $dummyModelVariable = null)
    {
        $this->dummyModelVariable = $dummyModelVariable;

        $this->setModel($dummyModelVariable->toArray());
    }

    public function render()
    {
        return view('dummy.prefix.save');
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
        $this->dummyModelVariable->fill($this->getModel())->save();

        $this->emit('hideModal');
        $this->emit('$refresh');
    }
}
