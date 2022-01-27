<?php

namespace App\Components\Topics;

use App\Models\Topic;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Read extends Component
{
    public $topic;

    public function mount(Topic $topic)
    {
        $this->topic = $topic;
    }

    public function getClass()
    {
        $titles = DB::table('classeds')
        ->where('name','!=','graduate')
        ->where('school_id',Auth::user()->school_id)
        ->pluck('id', 'name');
        return $titles;
    } 

    public function getSub()
    {
        $titles = DB::table('subjects')
        ->where('school_id',Auth::user()->school_id)
        ->pluck('id', 'name');
        return $titles;
    } 

    public function render()
    {
        return view('topics.read', [
            'getClass' => $this->getClass(),
            'getSub' => $this->getSub(),
        ]);
    }
}
