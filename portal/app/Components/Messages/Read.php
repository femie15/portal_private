<?php

namespace App\Components\Messages;

use App\Models\Message;
use Livewire\Component;

class Read extends Component
{
    public $message;

    public function mount(Message $message)
    {
        $this->message = $message;
    }

    public function render()
    {
        return view('messages.read');
    }
}
