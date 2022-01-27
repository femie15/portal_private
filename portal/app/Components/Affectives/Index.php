<?php

namespace App\Components\Affectives;

use Bastinald\Ux\Traits\WithModel;
use App\Models\Affective;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Section;
use Illuminate\Http\Request;

class Index extends Component
{
    use WithModel, WithPagination;
    public $clid;
    public $user,$query;

    protected $listeners = ['$refresh'];

    public function route()
    {

        return Route::get('affectives/{clid}', static::class)
            ->where('clid', '[0-9]+')
            ->name('affectives')
            ->middleware('auth');
    }

    public function mount($clid)
    {
// $this->hi();
        $this->setModel([
            'sort' => 'Name',
            'sorts' => ['Name', 'Newest', 'Oldest'],
            'filter' => $clid,
            'filters' => $this->classes()[1],
        ]);
    }

 public function hi()
    {
        
if(isset($_GET['name']) && $_GET['name'] !=''){
     dd($_GET['name']." is filled");
}

    }
    
    
    public function classes()
    {   
       $dt = DB::table('classeds')        
       ->where('name','!=','graduate')
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
    
    public function getClass()
    {
        $titles = DB::table('classeds')
        ->where('name','!=','graduate')
        ->pluck('id', 'name');  

        return $titles;
    }

        
    public function getTerm()
    {
        $titles = DB::table('terms')
        // ->where('school_id',Auth::user()->school_id)
        ->pluck('name', 'session');  
        foreach ($titles as $key => $value) {
            session(['term'=>$value,'sess'=>$key]);
            // dd(session()->get('term').'-|-'.session()->get('sess'));
        }
        return $titles;
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
        
        if ($this->getModel('filter')) 
        {
            $sect=DB::table('users')
            ->where('role','student')
            ->where('delet','!=','1')
            ->where('school_id',Auth::user()->school_id)
            ->where('section_id',$this->getModel('filter'))
            ->orderby('name')
            ->pluck('id', 'name');
            
            session(['sectid'=>$this->getModel('filter')]);
        }else{
            $sect=null;
        }

        // dd($sect);
        return $sect;        
    }

        
    public function getSubject()
    {
        if($this->getModel('filter')>0){
            $titles = DB::table('subjecttraits')
            // ->where('school_id',Auth::user()->school_id)
            // ->where('class_id',$this->getModel('filter'))
            ->orderby('name')
            ->pluck('id', 'name');  
            return $titles;
         }
    }

    public function hd(){
        if (isset($_GET['view']) && is_numeric($_GET['view']) && $_GET['view']>0){            
            $hid=$_GET['view'];
        }else{            
            $hid='hidden';
        }
        return $hid;
    }

    public function render()
    {
        return view('affectives.index', [
            'results' => $this->queryz(),
            'getSection' => $this->getSection(),
            'getClass' => $this->getClass(),
            'getStudent'=> $this->getStudent(),
            'hd' => $this->hd(),
            'getSubject' => $this->getSubject(),
            'getTerm' => $this->getTerm(),
        ]);
    }

    public function queryz()
    {
        $query=null;

        if ($search = $this->getModel('search')) {
            $query->where(function (Builder $query) use ($search) {
            });
        }

        if ($this->getModel('filter') && session()->get('term')!='' && session()->get('sess')!='' && session()->get('classid')!='') 
        {
                if (isset($_GET['view']) && is_numeric($_GET['view']) && $_GET['view']>0){            
                    $hid=$_GET['view'];
                
                    $query = DB::table('affectives')
                    ->Where('school_id', Auth::user()->school_id)
                    ->where('section_id', $this->getModel('filter'))
                    ->where('term', session()->get('term'))
                    ->where('session', session()->get('sess'))
                    ->where('class_id', session()->get('classid'))
                    ->where('subject_id', $hid)
                    ->get();
                }
            return $query;
        }else {
            return null;
        }        
    }

    public function delete(Affective $affective)
    {
        $affective->delete();
    }
}
