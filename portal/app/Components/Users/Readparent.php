<?php

namespace App\Components\Users;

use App\Models\User;
use Livewire\Component;

class Readparent extends Component
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('users.readparent'); 
    }
}
