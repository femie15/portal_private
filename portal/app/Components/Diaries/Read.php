<?php

namespace App\Components\Diaries;

use App\Models\Diary;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Read extends Component
{
    public $diary;

    public function mount(Diary $diary)
    {
        $this->diary = $diary;
    }

    
    public static function teacher($tip='')
    {
        $titles = DB::table('users')
        ->where('id',$tip)
        ->pluck('name');

        if (count($titles)>0) {            
            return $titles;
        }else {            
            return ['NULL'];
        }
    }     
    public static function topic($tip='')
    {
        $titles = DB::table('topics')
        ->where('id',$tip)
        ->pluck('name');

        if (count($titles)>0) {            
            return $titles;
        }else {            
            return ['NULL'];
        }
    }

    public function render()
    {
        return view('diaries.read');
    }
}
