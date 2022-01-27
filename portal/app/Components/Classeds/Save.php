<?php

namespace App\Components\Classeds;

use Bastinald\Ux\Traits\WithModel;
use App\Models\Classed;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Save extends Component
{
    use WithModel;

    public $classed;

    public function mount(Classed $classed = null)
    {
        $this->classed = $classed;

        $this->setModel($classed->toArray());
    }

    public function render()
    {
        return view('classeds.save');
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
        $this->classed->fill($this->getModel())->save();

        $this->emit('hideModal');
        $this->emit('$refresh');
    }
}
