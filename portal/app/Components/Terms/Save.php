<?php

namespace App\Components\Terms;

use Bastinald\Ux\Traits\WithModel;
use App\Models\Term;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Save extends Component
{
    use WithModel;

    public $term;

    public function mount(Term $term = null)
    {
        $this->term = $term;

        $this->setModel($term->toArray());
    }

    public function render()
    {
        return view('terms.save');
    }

    public function rules()
    {
        return [
            'name' => ['required'],
            'session' => ['required'],
        ];
    }

    public function save()
    {
        $this->validateModel();
        $this->setModel('school_id',Auth::user()->school_id);

        $this->term->fill($this->getModel())->save();

        $this->emit('hideModal');
        $this->emit('$refresh');
    }
}
