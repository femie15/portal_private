<?php

namespace App\Components\Results;

use Bastinald\Ux\Traits\WithModel;
use App\Models\Result;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Section;


class TabulationP extends Component
{
    use WithModel, WithPagination;
    public $clid;
    public $user,$query,$idc;

    protected $listeners = ['$refresh'];

    public function route()
    {
        return Route::get('tabulation', static::class)
            // ->where('clid', '[0-9]+')
            ->name('tabulation')
            ->middleware('auth');
    }

    public function mount()
    { 
        $this->setModel([
            // 'sort' => 'Select Class',
            'sorts' => $this->getClass(),
            // 'std' => $this->getClassId($this->getModel('sort')),
            // 'filter' => $clid,
            'filters' => $this->getTerm(),
        ]);
    }

    
    public function getClass()
    {
            $titles = DB::table('classeds')
            ->where('name','!=','graduate')
            ->where('deleted_at',NULL)
            ->pluck('name'); 
            // dd($titles); 
            return $titles;
    }

    public function getClassId($idc='')
    {
        $titles = DB::table('classeds')
            ->where('name','!=','graduate')
            ->where('deleted_at',NULL)
            ->where('name',$idc)
            ->pluck('id'); 
            
            if($titles && (count($titles)>0)){
                return $titles[0];   
            }else {
                return []; 
            }
    }
        
    public function getTerm()
    {
        $ts=[];
        $tms=$ar=[];
        $titles = DB::table('terms')
        ->where('school_id',Auth::user()->school_id)
        ->get();  
        // ->pluck
        foreach ($titles as $key => $value) {
            $conc=$value->session.' ('.$value->name.' Term)';
            array_push($ts,$conc);            
        }
        array_push($ar, $ts);
        // dd($ar);
        // dd($ts);
        if (count($ar)>0) {
            return $ar[0];
        }else{
            return null;
        }
    }

    public function getStudent()
    {
        $sect = DB::table('users')
                ->select(DB::raw('users.id as uid,users.name as uname,users.roll,users.section_id,sections.name as sname,sections.nick_name,classeds.name as cname'))
                ->join('sections', 'users.section_id', '=', 'sections.id')
                ->join('classeds', 'users.class_id', '=', 'classeds.id')
                ->where('users.class_id', $this->getClassId($this->getModel('sort')))
                ->orderby('users.name')
                ->get();
        if($sect && (count($sect)>0)){
            return $sect;        
        }else {
            return null; 
        }
    } 

        
    public function getSubject($sub='')
    {
        if($this->getModel('filter')>0){
//call result to get available subjects

            $titles = DB::table('subjects')
            // ->where('school_id',Auth::user()->school_id)
            ->where('id',$sub)
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
    {         $sar= $rr=[];
        if($this->querys()==''){
                $rr= $this->querys();
            }else{
                $rr= $this->querys()->paginate(100); 
                
                foreach($rr as $ary=>$t){
                    array_push($sar, $t);
                }             
            }
            // dd($sar);
            
            // dd($sar[0]->subject[0]['name']);

        return view('results.tabulation', [
            'results' =>$sar,
            'getStudent'=> $this->getStudent(),
            'filtr'=>$this->getModel('filter'),
            'sort'=>$this->getModel('sort'),
            // 'getTerm'=>$this->getTerm(),
        ]);
    }

    public function grade($sum=''){
        if($sum>=0 && $sum<=49){
            $grade="F9";
            $remark="Fail";
        }elseif($sum>=50 && $sum<=54){
            $grade="E8";
            $remark="Pass";
        }elseif($sum>=55 && $sum<=59){
            $grade="D7";
            $remark="Needs to improve";
        }elseif($sum>=60 && $sum<=64){
            $grade="C6";
            $remark="Satisfactory";
        }elseif($sum>=65 && $sum<=69){
            $grade="C5";
            $remark="Satisfactory";
        }elseif($sum>=70 && $sum<=74){
            $grade="C4";
            $remark="Satisfactory";
        }elseif($sum>=75 && $sum<=79){
            $grade="B3";
            $remark="Good";
        }elseif($sum>=80 && $sum<=84){
            $grade="B2";
            $remark="Good";
        }elseif($sum>=85 && $sum<=100){
            $grade="A1";
            $remark="Excellent";
        }else{
            $grade="-";
            $remark="-";
           }

           return ['grade'=>$grade,'remark'=>$remark];
    }

    public static function termly($sid='',$term='',$ses='',$sub=''){
        $titles = DB::table('results')
        ->Where('student_id', $sid)
        ->Where('session', $ses)   
        ->Where('term', $term)
        ->Where('subject_id', $sub)
        ->get(); 
            if ($titles && count($titles)>0) {
                $sum=$titles[0]->ca1+$titles[0]->ca2+$titles[0]->text1+$titles[0]->text2+$titles[0]->exam;
        }else{
            $sum=0;
        }

        return $sum;
    }

    public function clavg($term='',$ses='',$sub='',$clid='',$section=''){
        $foo = new Result();        
        $qu = $foo->seen($term,$ses,$sub,$clid,$section);
       
        return $qu;
    }

    public function query()
    {   
            if (is_numeric($this->getClassId($this->getModel('sort'))) && $this->getClassId($this->getModel('sort'))>0) 
            { 
                if ($this->getModel('filter') && $this->getModel('filter')!='') 
                {
                    $query = Result::query()->with('subject');
                    
                    $query->Where('school_id', Auth::user()->school_id);
                    $query->Where('class_id', $this->getClassId($this->getModel('sort')));
                    // dd($query);

                            //process term and session
                            $exp=explode(' (',$this->getModel('filter'));
                            $expt=explode(' T',$exp[1]);
                $query->Where('session', $exp[0]);   
                $query->Where('term', $expt[0])->distinct()->select('subject_id')->orderby('subject_id');   

                session(['sch'=>Auth::user()->school_id]); 
                session(['ses'=>$exp[0]]); 
                session(['tem'=>$expt[0]]); 
                session(['cls'=>$this->getClassId($this->getModel('sort'))]); 


                    return $query;
                }
                
            }else{
                $query= [];
                return null;
            }
    }

    public function querys()
    {   
        if (is_numeric($this->getClassId($this->getModel('sort'))) && $this->getClassId($this->getModel('sort'))>0) 
            { 
                if ($this->getModel('filter') && $this->getModel('filter')!='') 
                {
                    $query = Result::query()->with('subject');

                    $query->Where('school_id', Auth::user()->school_id);
                    $query->Where('class_id', $this->getClassId($this->getModel('sort')));


                            //process term and session
                            $exp=explode(' (',$this->getModel('filter'));
                            $expt=explode(' T',$exp[1]);
                    $query->Where('session', $exp[0]);   
                    $query->Where('term', $expt[0])->distinct()->select('subject_id')->orderby('subject_id');   

                    return $query;
                }
                
            }else{
                $query= [];
                return null;
            }
    }

    public function delete(Result $result)
    {
        $result->delete();
    }
}