<?php

namespace App\Components\Layouts;

use Bastinald\Ux\Traits\WithModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Nav extends Component
{
    protected $listeners = ['$refresh'];

    public function render()
    {
        return view('layouts.nav');
    }

   public function logout()
    {
        Auth::logout();

        return redirect()->to('/');
    }
}
