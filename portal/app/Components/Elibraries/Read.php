<?php

namespace App\Components\Elibraries;

use App\Models\Elibrary;
use Livewire\Component;

class Read extends Component
{
    public $elibrary;

    public function mount(Elibrary $elibrary)
    {
        $this->elibrary = $elibrary;
    }

    public function render()
    {
        return view('elibraries.read');
    }
}
