<?php

namespace App\Components\Noticeboards;

use App\Models\Noticeboard;
use Livewire\Component;

class Read extends Component
{
    public $noticeboard;

    public function mount(Noticeboard $noticeboard)
    {
        $this->noticeboard = $noticeboard;
    }

    public function render()
    {
        return view('noticeboards.read');
    }
}
