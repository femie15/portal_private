<?php

namespace App\Components\Affectives;

use Bastinald\Ux\Traits\WithModel;
use App\Models\Affective;
use Livewire\Component;

class Save extends Component
{
    use WithModel;

    public $affective;

    public function mount(Affective $affective = null)
    {
        $this->affective = $affective;

        $this->setModel($affective->toArray());
    }

    public function render()
    {
        return view('affectives.save');
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

        $this->affective->fill($this->getModel())->save();

        $this->emit('hideModal');
        $this->emit('$refresh');
    }
}
