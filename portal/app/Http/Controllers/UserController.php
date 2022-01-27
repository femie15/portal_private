<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function getData(Request $bere)
    {
        $collect=[];
        $volum=count($bere->input()['name']);
        
               
                for ($i=0; $i < $volum; $i++) { 
                    $stid=$bere->input()['name'][$i];
                    $sect=$bere->input()['section'];
                    $clid=$bere->input()['class'];
                    $sub=$bere->input()['sub'];
                    $ca1=$bere->input()['ca1'][$i];
                    $ca2=$bere->input()['ca2'][$i];
                    $text1=$bere->input()['text1'][$i];
                    $text2=$bere->input()['text2'][$i];
                    $exam=$bere->input()['exam'][$i];
                    $term=session()->get('term');
                    $sess=session()->get('sess');
                
                    $total=$bere->input()['totalup'][$i];
                    if ($total<10) {
                        $total='0'.$total;
                    }
                    // array_push($collect,['student_id'=>$stid,'section_id'=>$sect,'class_id'=>$clid,'subject_id'=>$sub,'ca1'=>$ca1,'ca2'=>$ca2,'text1'=>$text1,'text2'=>$text2,'exam'=>$exam,'term'=>$term,'session'=>$sess]);
                    // array_push($collect,[$stid,$sect,$clid,$sub,$ca1,$ca2,$text1,$text2,$exam,$term,$sess]);
                    
                    $que = Result::updateOrCreate(
                        ['student_id'=>$stid,'section_id'=>$sect,'class_id'=>$clid,'subject_id'=>$sub,'term'=>$term,'session'=>$sess],
                        ['school_id'=>Auth::user()->school_id,'ca1'=>$ca1,'ca2'=>$ca2,'text1'=>$text1,'text2'=>$text2,'exam'=>$exam,'total'=>$total]
                    );

                }
                
        return redirect('/results/0?success=yes');     
    }

    function getAtt(Request $bere)
    {
        $collect=[];
        $volum=count($bere->input()['name']);
        // dd($bere->input()['name']);
               
                for ($i=0; $i < $volum; $i++) { 
                    $stid=$bere->input()['name'][$i];
                    $tody=date('Y-m-d');
                    
                    $que = Attendance::updateOrCreate(
                        ['name'=>$stid,'wh'=>$tody,'school_id'=>Auth::user()->school_id],
                        ['name'=>$stid,'wh'=>$tody,'school_id'=>Auth::user()->school_id]
                    );

                    //Send notification to parent for attendance.
                }
                
        return redirect('/attendances/0?success=yes');     
    }
        
}