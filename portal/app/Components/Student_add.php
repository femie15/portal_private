<?php

namespace App\Components;

use Illuminate\Support\Facades\Route;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Student_add extends Component
{
    public $dta,$engl;
    
    public function route()
    {
        return Route::get('student_add', static::class)
            ->name('student_add')
            ->middleware('auth');
    }
    
    public function get_phrase($phrase='')
    {   
       $dt = DB::table('languages')
       ->select(DB::raw('english'))
       ->where('phrase','=',$phrase)
       ->get();

       foreach ($dt as $gp){
        $engl=$gp->english;
        if ($engl != ''){                
                        $engl=ucwords($engl);
                        }else{
                            $engl= ucwords(str_replace('_',' ',$phrase));
                        }
            return $engl;
       }
    }
    
    public function notices()
    {   
       $dt = DB::table('noticeboard')
       ->get();

       return $dt;       
    }
    
    public function classes()
    {   
       $dt = DB::table('classeds')        
       ->where('name','!=','graduate')
       ->get();
       return $dt;       
    }

    function get_class_section($class_id='')
    {
        // $dta='[';
        $dt = DB::table('section')->where('class_id' , $class_id)->get();
        // foreach ($dt as $row) {
        //     // $dta.='<option value="' . $row->section_id. '">' . $row->name . '</option>';
        //     $dta.='"' . $row->name. '",';
        // }
        // $dta.=']';
        return $dt;
    }

    public function settings()
    {   
        $dt = DB::table('settings')        
       ->where('settings_id','16')
       ->get('description');
       
        foreach ($dt as $clr)
        {
            $dt=$clr->description;
           // return $dt;
        }
       return  session()->put('theme', $dt);
    }

    public function render()
    {
        return view('student_add', [
            'get_phrase'=> $this->get_phrase(),
            'notices'=> $this->notices(),
            'settings'=> $this->settings(),
            'classes'=> $this->classes(),
            'get_class_section'=> $this->get_class_section(),
        ]);
    }
}