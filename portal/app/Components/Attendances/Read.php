<?php

namespace App\Components\Attendances;

use App\Models\Attendance;
use Livewire\Component;
use App\Models\User;

class Read extends Component
{
    public $attendance;

    public function mount(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    public function getParent($pid='')
    {
        if($pid>=0){
        $sect=User::all()->where('role','student')->where('id',$pid)
        ->pluck('name'); 
        
            if (count($sect)>=1) {
                $sect=$sect[0];
            }else{
                $sect=null;
            }
        }else{
            $sect=null;
        }       
            return $sect;
        
    }

    public function render()
    {
        return view('attendances.read');
    }
}
