<?php

namespace App\Components\Subjecttraits;

use App\Models\Subjecttrait;
use Livewire\Component;

class Read extends Component
{
    public $subjecttrait;

    public function mount(Subjecttrait $subjecttrait)
    {
        $this->subjecttrait = $subjecttrait;
    }

    public function render()
    {
        return view('subjecttraits.read');
    }
}
