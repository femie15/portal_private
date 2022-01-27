<?php

namespace App\Components\Terms;

use App\Models\Term;
use Livewire\Component;

class Read extends Component
{
    public $term;

    public function mount(Term $term)
    {
        $this->term = $term;
    }

    public function render()
    {
        return view('terms.read');
    }
}
