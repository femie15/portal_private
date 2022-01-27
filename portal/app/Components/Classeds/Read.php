<?php

namespace App\Components\Classeds;

use App\Models\Classed;
use Livewire\Component;

class Read extends Component
{
    public $classed;

    public function mount(Classed $classed)
    {
        $this->classed = $classed;
    }

    public function render()
    {
        return view('classeds.read');
    }
}
