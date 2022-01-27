<?php

namespace App\Components\Attendances;

use Bastinald\Ux\Traits\WithModel;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Section;

class Index extends Component
{
    use WithModel, WithPagination;

    protected $listeners = ['$refresh'];

    public function route()
    {
        return Route::get('attendances/{clid}', static::class)
            ->where('clid', '[0-9]+')
            ->name('attendances')
            ->middleware('auth');
    } 

    public function mount($clid)
    {
        $this->setModel([
            'sort' => 'Name',
            'sorts' => ['Name', 'Newest', 'Oldest'],
            'sid' => $clid,
            // 'filter' => $clid,
            'filters' => $this->classes()[1],
        ]);
    }

    public function getClass()
    {
        $titles = DB::table('classeds')
        ->where('name','!=','graduate')
        ->where('school_id',Auth::user()->school_id)
        ->pluck('id', 'name');  

        return $titles;
    }
 
    public function classes()
    {   
       $dt = DB::table('classeds')        
       ->where('name','!=','graduate')
       ->where('school_id',Auth::user()->school_id)
       ->get();
       $arn=$arid=$ar=[];

            foreach ($dt as $key => $value) {
                array_push($arn, $value->name);
                array_push($arid, $value->id);
            }
       array_push($ar, $arid);
       array_push($ar, $arn);
       return $ar;       
    }

    public function getSection()
    {
            $sect = DB::table('sections')
            ->where('school_id',Auth::user()->school_id)
            ->where('class_id', '0')
            ->get();
            
        $lopd=count($this->classes()[1]);
        for ($i=0; $i < $lopd ; $i++) {
            if ($this->getModel('filter') == $this->classes()[1][$i]) {
                $sect = DB::table('sections')
                ->where('school_id',Auth::user()->school_id)
                ->where('class_id', $this->classes()[0][$i])
                ->get();
            }
        }
        return $sect;        
        
    }

    public function getStudent()
    {
        
        if ($this->getModel('sid')) 
        {
            $sect=DB::table('users') 
            // ->select(DB::raw('users.name, users.id as uid, attendances.wh'))
            // ->join('attendances', 'users.id', '=', 'attendances.name')
            ->where('users.role','student')
            ->where('users.delet','!=','1')
            ->where('users.school_id',Auth::user()->school_id)
            ->where('users.section_id',$this->getModel('sid'))
            ->orderby('name')
            ->get();
            
            session(['sectid'=>$this->getModel('sid')]);
        }else{
            $sect=null;
        }

        // dd($sect);
        return $sect;        
    }

    
    public function getAtt($uid='', $day='')
    {
        // dd($uid,$day);
        $titles = DB::table('attendances')
        ->where('name',$uid)
        ->where('wh',$day)
        ->get();  
        if($titles!='' && \count($titles)>0){
                return $titles[0]->name;
            }else{
                return null;
            }

    }

    public static function countAtt()
    {
        $titles = DB::table('attendances')
        ->where('school_id', Auth::user()->school_id)
        ->where('wh',date('Y-m-d'))
        ->get()->count();
        
        return $titles;
    }
    
    public function render()
    {
        return view('attendances.index', [
            'attendances' => $this->query(),
            'getSection' => $this->getSection(),
            'getClass' => $this->getClass(),
            'getStudent'=> $this->getStudent(),
            'filtr'=>$this->getModel('filter'),
        ]);
    }

    public function query()
    {
        $query=null;

        if ($this->getModel('filter') && session()->get('classid')!='') 
        {
            // $hid=$_GET['view'];
                
                    $query = DB::table('attendances')
                    ->get();
            return $query;
        }else {
            return null;
        }
    }

    public function delete(Attendance $attendance)
    {
        $attendance->delete();
    }
}
