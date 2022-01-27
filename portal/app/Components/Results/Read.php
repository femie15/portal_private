<?php

namespace App\Components\Results;

use App\Models\Result;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Position;
use Illuminate\Http\Request;

class Read extends Component
{
    public $result;

    public function mount(Result $result)
    {
        $this->result = $result;
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
        if (count($ar)>0) {
            return $ar[0];
        }else{
            return null;
        }
    }

    public function getClass()
    {
            $titles = DB::table('classeds')
            ->where('name','!=','graduate')
            ->where('deleted_at',NULL)
            ->pluck('name','id'); 
            // dd($titles); 
            return $titles;
    }
     
    
    
    public function corr(Request $bere)
    {
         // dd($bere->input()['cls']);
        $exp=explode(' (',$bere->input()['ts']); //session
        $expt=explode(' T',$exp[1]); //term
        $session=$exp[0];
        $term=$expt[0];
        
        
        $ssbb = DB::table('results') 
                ->select(DB::raw('id, student_id, subject_id'))
                ->Where('class_id', $bere->input()['cls'])
                ->Where('school_id', Auth::user()->school_id)
                ->Where('session', $session)   
                ->Where('term', $term)
                ->get(); 
        
        foreach ($ssbb as $keys => $values) {
            
                $affected = DB::table('results')
              ->where('student_id', $values->student_id)
              ->where('subject_id', $values->subject_id)
              ->where('id','>', $values->id)
                ->Where('class_id', $bere->input()['cls'])
                ->Where('school_id', Auth::user()->school_id)
                ->Where('session', $session)   
                ->Where('term', $term)
              ->update(['school_id' => 1,
                        'student_id'=>$values->student_id.'_1'
                        ]);                
        }
        

     $this->position($bere->input()['cls'],$term,$session); //subject position
     $this->termposition($bere->input()['cls'],$term,$session); // correct duplicates
     
     return redirect()->to('/tabulation?done=yes');
    }
    
    
    function termposition($cls='',$term='',$session='')
    { 
        // dd($bere->input()['cls']);
        // $exp=explode(' (',$bere->input()['ts']); //session
        // $expt=explode(' T',$exp[1]); //term
        // $session=$exp[0];
        // $term=$expt[0];
// dd($term.'-'.$session);

        $ss = DB::table('sections')      
        ->Where('class_id', $cls)
        ->Where('school_id', Auth::user()->school_id)
        ->get(); 
        if (count($ss)>0) 
        {          
            foreach ($ss as $key => $val) 
            {
                
           
//start
        $termpos = DB::table('results')      
                ->select(DB::raw('student_id,sum(total) as tot'))
                ->Where('class_id', $cls)
                ->Where('section_id', $val->id)
                ->Where('school_id', Auth::user()->school_id)
                ->Where('session', $session)   
                ->Where('term', $term)
                ->orderbyDesc('tot')
                ->groupby('student_id')
                ->get(); 
 
        $posn=1;
        $position=1;
        $totalScrPrv=0;
        $coun=0;

        if ($termpos) 
        {          
            // dd($termpos);
            foreach ($termpos as $key => $value) 
            {  
                //calculate position
                    if ($totalScrPrv==$value->tot)
                        {
                            $position=$position;                            
                        }
                        else
                        {
                            $position=$posn+$coun;
                        }   

                        $coun=$coun+1;
                        $totalScrPrv=$value->tot;  
 
 
                // if($value->student_id == 1232){
                // dd($totalScrPrv);
                // }
                
                $usd = DB::table('users')      
                ->select(DB::raw('section_id'))
                ->Where('id', $value->student_id)
                ->Where('section_id', $val->id)
                ->Where('school_id', Auth::user()->school_id)
                ->pluck('section_id'); 
                // dd($usd[0]);
                if(count($usd)>0){
                    if($usd[0]==$val->id){
                        $Position = Position::updateOrCreate(
                            ['student_id'=>$value->student_id,'class_id'=>$cls,'term_id'=>$term,'session'=>$session],
                            ['term_avg'=>$totalScrPrv, 'term_position'=>$position]
                        );
                    }
                }
            }
        }
//end 
       }
     }
     
    }


   public function position($cls='',$term='',$session='')
    {
        $ssbb = DB::table('results')      
                ->distinct()  
                ->select(DB::raw('subject_id'))
                ->Where('class_id', $cls)
                ->Where('school_id', Auth::user()->school_id)
                ->Where('session', $session)   
                ->Where('term', $term)
                ->orderbyDesc('subject_id')
                ->get(); 
        
        foreach ($ssbb as $keys => $values) {
            
        $ss = DB::table('sections')      
        ->Where('class_id', $cls)
        ->Where('school_id', Auth::user()->school_id)
        ->get(); 
        if (count($ss)>0) 
        {           
            foreach ($ss as $key => $val) 
            {
        
                $titles = DB::table('results')    
                ->select(DB::raw('id, total'))
                ->Where('school_id', Auth::user()->school_id)
                ->Where('class_id', $cls)
                ->Where('section_id', $val->id)
                ->Where('session', $session)   
                ->Where('term', $term)
                ->Where('subject_id', $values->subject_id)
                ->orderbyDesc('total')
                ->get(); 

                        //finding position for the tabulation sheet on the broader_sheet table
					    $posn=1;
                        $position=1;
                        $totalScrPrv=0;
                        $coun=0;
                        
                if ($titles) {                    
                    foreach ($titles as $key => $value) {
                        // dd($value);          
                        if ($totalScrPrv==$value->total)
                        {
                            $position=$position;                            
                        }
                        else
                        {
                            $position=$posn+$coun;
                        } 
                        $coun=$coun+1;
                        $totalScrPrv=$value->total;  


        DB::update('update `results` set `position` = ? where `id` = ?',[$position,$value->id]);

                    }
                }
            }
        }
    }
     
}

    
    
    public function render()
    {
        return view('results.read',[
            'ss'=>$this->getTerm(),
            'cls'=>$this->getClass(),
        ]);
    }
}
