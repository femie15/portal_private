<?php

namespace App\Components\Users;

use App\Models\User;
use Livewire\Component;

class Readteacher extends Component
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('users.readteacher'); 
    }
}
