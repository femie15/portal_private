<?php

namespace App\Components\Schools;

use App\Models\School;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Read extends Component
{
    public $school;

    public function mount(School $school)
    {
        $this->school = $school;
    }

    public static function seeposition()
    {
        $titles = DB::table('schools')
        ->where('school_id',Auth::user()->school_id)
        ->pluck('view_position');
        return $titles[0];
    } 
    
    public function render()
    {
        return view('schools.read');
    }
}
 