<?php

namespace App\Components\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Read extends Component
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function getClass()
    {
        $titles = DB::table('classeds')
        ->where('name','!=','graduate')
        ->where('school_id',Auth::user()->school_id)
        ->pluck('id', 'name');  
        return $titles;
    }

    public function getParent($pid='')
    {
        if($pid>=0){
        $sect=User::all()->where('role','parent')->where('id',$pid)
        ->pluck('name'); 
        // dd($sect);
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

    public function getSection()
    {
        $sect = DB::table('sections')
        ->where('school_id',Auth::user()->school_id)
        ->get();    
        return $sect;
    }

    public static function getUser($tip='')
    {
        $titles = DB::table('users')
        ->where('id',$tip)
        ->get();

        if (count($titles)>0) {            
            return ["em"=>$titles[0]->name.' (Email: '.$titles[0]->email.' | Phone: '.$titles[0]->phone.')',"other"=>$titles[0]];
        }else {            
            return ["em"=>NULL, "other"=>NULL];
        }
    }
    

    public function render()
    {
        return view('users.read', [
            'getSection' => $this->getSection(),
            'getClass' => $this->getClass(),
        ]); 
    }
}
