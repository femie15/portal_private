<?php

namespace App\Imports;

use App\Models\Result;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ResultsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row[0]);
if ($row[0]!='Students ID' && $row[0]!='' && $row[2]!='' && $row[3]!='' && $row[4]!='' && $row[5]!='') {
    // if ($row[0]!='Students ID' && $row[0]!='' && $row[6]!='' && $row[2]!='' && $row[3]!='' && $row[4]!='' && $row[5]!='') {
    
        $sect = DB::table('users')
        ->where('roll',$row[0])
        ->get();
        
        if (count($sect)>0) {
           
        // dd($sect[0]->name.'('.$sect[0]->id.')');

        // return new Result([
        //     'id' => NULL,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     'student_id' => $sect[0]->id,
        //     'subject_id' => session()->get('sb'),
        //     'term' => session()->get('term'),
        //     'session' => session()->get('sess'),
        //     'class_id' => session()->get('classid'),
        //     'section_id' => session()->get('scid'),
        //     'school_id' => Auth::user()->school_id,
        //     'ca1' => $row[2],
        //     'ca2' => $row[3],
        //     'text1' => $row[4],
        //     'text2' => $row[5],
        //     'exam'  => $row[6],
        //     'total'  => ($row[2]+$row[3]+$row[4]+$row[5]+$row[6]),
        // ]);
        // $j='';
        // for ($i=2; $i < 7; $i++) { 
        //     if ($row[$i]='') {
        //         $row[$i]=0;
        //     }
        //     $j.=$row[$i].'-';
        // }
        // dd($row);

$total=$row[2]+$row[3]+$row[4]+$row[5]+$row[6];
if ($total<10) {
    $total='0'.$total;
}
       $que = Result::updateOrCreate(
            ['student_id'=>$sect[0]->id,'section_id'=>session()->get('scid'),'class_id'=>session()->get('classid'),'subject_id'=>session()->get('sb'),'term'=>session()->get('term'),'session'=>session()->get('sess')],
            ['school_id'=>Auth::user()->school_id,'ca1'=>$row[2],'ca2'=>$row[3],'text1'=>$row[4],'text2'=>$row[5],'exam'=>$row[6],'total'=>$total]
            );
        
        return $que;
        
      }else{
          dd('One of the Roll number ('.$row[0].') is not correct');
      }
    }
}


}
