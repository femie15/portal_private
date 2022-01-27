<?php

namespace App\Components\Layouts;

use Bastinald\Ux\Traits\WithModel;
use App\Models\Language; 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    // public $com = '\App\Components\Layouts\sidebar::get_phrase';
 
    public function render()
    {
        return view('layouts.navigation', [
            'get_phrase'=> $this->get_phrase(),
            'settings'=> $this->settings(),
            'classes'=> $this->classes(),
            'getParent'=> $this->getParent(),
        ]);
    }
    
    

    public function getParent()
    {
        if(Auth::user()->role =="parent")
        {
        $sect = DB::table('users')
                ->where('parent_id', Auth::user()->id)
                ->get();  
                   
                return $sect;        
            
        }else{   
            return null;        
        }
    }
    

    public function classes()
    {   
       $dt = DB::table('classeds')        
       ->where('name','!=','graduate')
       ->where('school_id',Auth::user()->school_id)
       ->where('deleted_at','=',NULL)
       ->get();

    if ($dt !='' || $dt !=[] || !empty($dt)) {
        return $dt;
       }else {
        return null;
       } 
   
    }

    public function get_phrase()
    {   
       $dt = DB::table('languages')
       ->select(DB::raw('phrase,english'))
    //    ->where('phrase','=',$phrase)
       ->get();
       return $dt;
    }

    public function settings()
    {   
       $dta = DB::table('settings')
       ->select(DB::raw('type, description'))
       ->get();
       return $dta;
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->to('/');
    }

}
