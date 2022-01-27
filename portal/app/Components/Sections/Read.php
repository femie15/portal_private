<?php

namespace App\Components\Sections;

use App\Models\Section;
use Livewire\Component;

class Read extends Component
{
    public $section;

    public function mount(Section $section)
    {
        $this->section = $section;
    }

    public function render()
    {
        return view('sections.read');
    }
}
