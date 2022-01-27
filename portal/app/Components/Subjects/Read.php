<?php

namespace App\Components\Subjects;

use App\Models\Subject;
use Livewire\Component;

class Read extends Component
{
    public $subject;

    public function mount(Subject $subject)
    {
        $this->subject = $subject;
    }

    public function render()
    {
        return view('subjects.read');
    }
}
