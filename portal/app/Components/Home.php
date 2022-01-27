<?php

namespace App\Components;

use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Home extends Component
{
    public function route()
    {
        return Route::get('home', static::class)
            ->name('home')
            ->middleware('auth');
    }

    public function get_sub()
    {              
        $query =  DB::table('subjects')
        ->select(DB::raw('name'))
        ->orderBy('name')
        ->get();

        return $query;
    }

    public function get_class()
    {              
        $query =  DB::table('classeds')
        ->select(DB::raw('name'))
        ->where('name','!=','graduate')
        ->get();

        return $query;
    }

    public function classed_school()
    {              
        // dd(date("Y-m-d h:i:s"));
        $dnow= date("Y-m-d h:i:s");
        $query =  DB::table('classed_school')
        // ->select(DB::raw('name'))
        ->where('school_id',Auth::user()->school_id)
        ->where('start_time','>=',$dnow)
        ->orderBy('class_id')
        ->get();
        
        return $query;
    }

    public function render()
    {
        return view('home',[
            'get_sub'=> $this->get_sub(),
            'get_class'=> $this->get_class(),
            'classed_school'=> $this->classed_school(),
        ]);
    }
}
