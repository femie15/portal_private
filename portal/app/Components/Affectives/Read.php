<?php

namespace App\Components\Affectives;

use App\Models\Affective;
use Livewire\Component;

class Read extends Component
{
    public $affective;

    public function mount(Affective $affective)
    {
        $this->affective = $affective;
    }

    public function render()
    {
        return view('affectives.read');
    }
}
