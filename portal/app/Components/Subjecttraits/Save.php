<?php

namespace App\Components\Subjecttraits;

use Bastinald\Ux\Traits\WithModel;
use App\Models\Subjecttrait;
use Livewire\Component;

class Save extends Component
{
    use WithModel;

    public $subjecttrait;

    public function mount(Subjecttrait $subjecttrait = null)
    {
        $this->subjecttrait = $subjecttrait;

        $this->setModel($subjecttrait->toArray());
    }

    public function render()
    {
        return view('subjecttraits.save');
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

        $this->subjecttrait->fill($this->getModel())->save();

        $this->emit('hideModal');
        $this->emit('$refresh');
    }
}
