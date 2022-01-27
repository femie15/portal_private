<x-ux::layouts.page>  
    <style>
    .table-resp {
    width: 65%;
    overflow-x: auto;
}

.table-respo {
    width: 95%;
    overflow-x: auto;
}
</style>

 @php
     $d='';
 @endphp

@if ($filtr=='') 
   @php
    $fil='Select Term and Session';
    $position=$d='';
    $ltposition='';
    $getStudent='';  
    $promotion_status='';
    $ft=$sc=$tt=$sn=$av=0;
   @endphp
<center>
    <x-ux::action-dropdown key="filter" label="{{ $fil }}" icon="calendar"/>
</center>
@else
    @php
        $fil=$filtr;
        $exp=explode(' (',$this->getModel('filter'));
        $expt=explode(' T',$exp[1]);
        $getStudent='\App\Components\Results\Bulk'::getStudent();        
        $promotion_status='';
        $ft=$sc=$tt=$sn=$av=0;

        $view_position='\App\Components\Schools\Read'::seeposition();
    @endphp
{{-- <center>
    <x-ux::action-dropdown key="filter" label="{{ $fil }}" icon="calendar"/>
</center> --}}

@if ($getStudent && count($getStudent)>=1) 
<script type="text/javascript">
    $(document).ready(function(){
        $('#dis').css('display', 'none');
    });
</script>

    @foreach ($getStudent as $getStud)
        @php
    $ft=$sc=$tt=$sn=$av=0;
            $classn= $getStud->cname;
            $aa= $getStud->uname.' Report Sheet';
            $sectn= $getStud->sname;
            $classn= $getStud->cname;
            $roll= $getStud->roll;
            $nick= $getStud->nick_name;
            $gender= $getStud->gender;
            $stuid= $getStud->stuid;

    $position='\App\Components\Results\Bulk'::getposition($exp[0],$expt[0],$stuid);
   
    if ($expt[0]=='1st') {
            $ltposition=$position;
    }elseif ($expt[0]=='2nd') {
            $ltposition='\App\Components\Results\Bulk'::getposition($exp[0],'1st',$stuid);
    }elseif ($expt[0]=='3rd'){
            $ltposition='\App\Components\Results\Bulk'::getposition($exp[0],'2nd',$stuid);
    }else {
        $ltposition='';
    }
        $results='\App\Components\Results\Bulk'::rst($stuid);        
    @endphp


<div style="width:100%; page-break-after: always;"> 
@if ($results && (count($results)>0))   
<br>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <img src="../assets/images/header.png" width="100%" height="100px"/>
    </div>	
</div>
<hr style="margin-top:0px;" />

                    @php           
                    $path_to_file ='assets/images/users/'.$results[0]->student_id.'.jpg';     
                    @endphp 

                        @if (File::exists(public_path($path_to_file)))  
                            <x-ux::image asset="{{ $path_to_file }}" width="90px" height="90px" style="float:right; margin-top:15px; margin-right:10px; border-radius:15px;"/> 
                        @else 
                            <x-ux::action icon="user fa-6x" :title="__('Add Image')" click="$emit('showModal', 'users.save', {{ $results[0]->student_id }} )" width="90px" height="90px" style="float:right; margin-top:15px; margin-right:10px; border-radius:15px;"/> 
                           
                        @endif                     
<br>
<br>
<h3 style="color:blue;">
    <i class="fa fa-flag"></i> 
    {{ $aa }}
</h3>

<table class="table table-stripped table-resp">
    <tr>
        <td>Admission No:</td>
        <td>{{ $roll }}</td>
        <td>Class:</td>
        <td>{{ $classn }}</td>
    </tr>
    
    <tr>
        <td>Gender:</td>
        <td>{{ strtoupper($gender) }}</td>
        <td >Section: </td>
        <td>{{ $sectn }} ({{ $nick }})</td>
    </tr>
    <tr>
        <td>Term ends:</td>
        <td>{{ $getTerm[0]['start'] }}</td>
        <td >Next term begins: </td>
        <td>{{ $getTerm[0]['end'] }}</td>
    </tr>

@if ($view_position=='Yes')
@php
    $lala= substr($position, -1);
    $lall= substr($ltposition, -1);
    if ($lala=='1') {
        $position=$position.'st';
    }elseif ($lala=='2') {
        $position=$position.'nd';
    }elseif ($lala=='3') {
        $position=$position.'rd';
    }else{
        $position=$position.'th';
    }

    
    if ($lall=='1') {
        $ltposition=$ltposition.'st';
    }elseif ($lall=='2') {
        $ltposition=$ltposition.'nd';
    }elseif ($lall=='3') {
        $ltposition=$ltposition.'rd';
    }else{
        $ltposition=$ltposition.'th';
    }
    
        
    
    if ($position=='11') {
        $position=$position.'th';
    }
    if ($ltposition=='11') {
        $ltposition=$ltposition.'th';
    }
    
@endphp

    <tr>
        <td>Position:</td>
        <td>{{ $position }}</td>
        <td>Last Term Position: </td>
        <td>{{ $ltposition }}</td>
    </tr>
@endif
</table>

<center>	<br>
<table width="95%" class="table table-stripped table-bordered table-respo"  style='font-weight: 700; font-size:12px;'>
        <tr><h4><b>COGNITIVE SKILL (ACADEMIC)</b></h4></tr>
    <tr  width="100%">																		
        <tr>
        <th rowspan="3"><div width="30px"><center>SUBJECTS</center></div></th>
        <th colspan="4"><div><center> C.A.</center></div></th>
        <th rowspan="2"><div class="rotate"> <br> <br> EXAM</div></th>
        <th rowspan="2"><div class="rotate"> &emsp;Total<br> &emsp;Score</div></th>
        <th rowspan="3"><div class="rotate"><center>CLASS <br>AVERAGE</center></div></th>
        <th rowspan="3"><div class="rotate"> GRADE</div></th>
        <th rowspan="3"><div class="rotate"> REMARKS</div></th>			
    @if ($view_position=='Yes')
        <th rowspan="3"><div class="rotate"> POSITION</div></th>            
    @endif			
        <th colspan="4"><div><center>YEAR SUMMARY</center></div></th>	             
        </tr>

        <tr>
            <td color="black"><center>ASSIGNMENT 1</center></td>
            <td class="rotate" height="0"> <center>ASSIGNMENT 2</center></td>
            <td class="rotate"> TEST 1</td>
            <td class="rotate"> TEST 2</td>
            <td class="rotate" rowspan="2"> 1st Term </td>
            <td class="rotate" rowspan="2"> 2nd Term </td>
            <td class="rotate" rowspan="2"> 3rd Term </td> 
            <td class="rotate" rowspan="2"> Ave Score</td>  
        </tr>

        @if ($classn =='JSS1' || $classn =='JSS2' || $classn =='JSS3')
            <td><center> 10 </center></td>
            <td><center>10 </center></td>
            <td><center>20 </center></td>
            <td><center> 20 </center></td>
            <td><center> 40 </center></td>
            <td><center> 100 </center></td>            
        @else
            <td><center> 5 </center></td>
            <td><center>5 </center></td>
            <td><center>10 </center></td>
            <td><center>10 </center></td>
            <td><center>70 </center></td>
            <td><center>100 </center></td>            
        @endif

    </tr>
@foreach($results as $result)   
   
    @if($result->total > 0)
    
                   
    @php
    
    $sum=$result->ca1+$result->ca2+$result->text1+$result->text2+$result->exam;
    // if ($classn =='JSS1' || $classn =='JSS2' || $classn =='JSS3') {
    //     $sumg=($sum/60)*100;
    // }else {
    //     $sumg=($sum/30)*100;
    // }
    
$firstterm='\App\Components\Results\Bulk'::termly($result->student_id,'1st',$result->session,$result->subject_id);
$secondterm='\App\Components\Results\Bulk'::termly($result->student_id,'2nd',$result->session,$result->subject_id);
$thirdterm='\App\Components\Results\Bulk'::termly($result->student_id,'3rd',$result->session,$result->subject_id);
$oneq= ($firstterm>=1 && $secondterm<1 && $thirdterm<1) ||
       ($firstterm<1 && $secondterm>=1 && $thirdterm<1) ||
       ($firstterm<1 && $secondterm<1 && $thirdterm>=1);
$towq= ($firstterm>=1 && $secondterm>=1 && $thirdterm<1) ||
       ($firstterm<1 && $secondterm>=1 && $thirdterm>=1) ||
       ($firstterm>=1 && $secondterm<1 && $thirdterm>=1);
$thrq= ($firstterm>=1 && $secondterm>=1 && $thirdterm>=1);

if ($oneq) {
   $dv=1;
}elseif ($towq) {    
   $dv=2;
}elseif ($thrq) {    
   $dv=3;
}else {
   $dv=1;
}

$avgscore=number_format((($firstterm+$secondterm+$thirdterm)/$dv),2);
$ft+=$firstterm;
$sc+=$secondterm;
$tt+=$thirdterm;
$av+=$avgscore;
$sn++;

@endphp


         <tr>
            <td>{{ $result->subject[0]->name }}</td>
            <td><center> {{ $result->ca1 }}</center> </td>
            <td><center> {{ $result->ca2 }} </center></td>                               
            <td><center> {{ $result->text1 }} </center></td>
            <td><center> {{ $result->text2 }} </center></td>
            <td><center> {{ $result->exam }} </center></td>
            <td><center> {{ $sum }} </center></td>
            <td><center> {{ '\App\Components\Results\Bulk'::clavg($result->term,$result->session,$result->subject_id,$result->class_id,$result->section_id) }} </center></td>
            
    
        @if ($classn =='JSS1' || $classn =='JSS2' || $classn =='JSS3')
            <td><center>{{ '\App\Components\Results\Bulk'::gradej($sum)['grade'] }} </center></td>
           <td><center>{{ '\App\Components\Results\Bulk'::gradej($sum)['remark'] }}</center></td>                
        @else
            <td><center>{{ '\App\Components\Results\Bulk'::grade($sum)['grade'] }} </center></td>
            <td><center>{{ '\App\Components\Results\Bulk'::grade($sum)['remark'] }}</center></td>                
        @endif
@php
    $lala= substr($result->position, -1);
    if ($lala=='1') {
        $den=$result->position.'st';
    }elseif ($lala=='2') {
        $den=$result->position.'nd';
    }elseif ($lala=='3') {
        $den=$result->position.'rd';
    }else{
        $den=$result->position.'th';
    }
@endphp
@if ($view_position=='Yes')
    <td><center> {{ $den }} </center></td>
@endif
        <td><center>
            {{ $firstterm }}
            </center></td>
        <td><center>
            {{ $secondterm }}
        </center></td>
        <td><center>                
            {{ $thirdterm}}
        </center></td>

        <td><center> {{ $avgscore }}</center></td>

        </tr>
        
        @endif 
        
        
    @endforeach
    
    

    </table>

    @php
        $promo=$av/$sn;
        $bod="hidden";
        $thir=$tt/$sn;
                //Promotion status
                    if ($thir>=1)
                    {
                        if ($promo>=50)
                        {
                            $promotion_status="PROMOTED TO NEXT CLASS";
                            $bod="";
                        }
                        else
                        {
                            $promotion_status="REPEAT CLASS";
                            $bod="";
                        }
                    }

         if ($classn =='JSS1' || $classn =='JSS2' || $classn =='JSS3'){
                if($promo>=0 && $promo<14.9){
                    $gtr="POOR RESULT";
                    $ar="YOU NEED TO WORK HARDER";
                }elseif($promo>=15 && $promo<29.9){
                    $gtr="A WEAK PERFOMANCE";
                    $ar="PUT MORE EFFORT TO IMPROVE";
                }elseif($promo>=30 && $promo<39.9){
                    $gtr="AN AVERAGE PERFOMANCE";
                    $ar="YOU CAN DO BETTER";
                }elseif($promo>=40 && $promo<45.9){
                    $gtr="A GOOD RESULT";
                    $ar="YOU CAN DO BETTER";
                }elseif($promo>=45 && $promo<=50.9){
                    $gtr="VERY GOOD PERFORMANCE";
                    $ar="BRILLIANT, KEEP IT UP";
                }elseif($promo>=50 && $promo<=60){
                    $gtr="EXCELLENT PERFORMANCE";
                    $ar="BRILLIANT, KEEP IT UP";
                }else{
                    $gtr="-----";
                    $ar="-----";
                    }
        }else{
                if($promo>=0 && $promo<9){
                    $gtr="POOR RESULT";
                    $ar="YOU NEED TO WORK HARDER";
                }elseif($promo>=9 && $promo<14.5){
                    $gtr="A WEAK PERFOMANCE";
                    $ar="PUT MORE EFFORT TO IMPROVE";
                }elseif($promo>=14.5 && $promo<20){
                    $gtr="AN AVERAGE PERFOMANCE";
                    $ar="YOU CAN DO BETTER";
                }elseif($promo>=20 && $promo<23){
                    $gtr="A GOOD RESULT";
                    $ar="YOU CAN DO BETTER";
                }elseif($promo>=23 && $promo<=25){
                    $gtr="VERY GOOD PERFORMANCE";
                    $ar="BRILLIANT, KEEP IT UP";
                }elseif($promo>=25 && $promo<=30){
                    $gtr="EXCELLENT PERFORMANCE";
                    $ar="BRILLIANT, KEEP IT UP";
                }else{
                    $gtr="-----";
                    $ar="-----";
                    }
            }
@endphp

<table class="table table-stripped">
        <tr>
            <td rowspan="2"><center>&emsp;1st term Average:&emsp;{{ number_format(($ft/$sn),2)}}&emsp;</center></td>
            <td rowspan="2"><center>&emsp;2nd term Average:&emsp;{{ number_format(($sc/$sn),2) }}&emsp;</center></td>
            <td rowspan="2"><center>&emsp;3rd term Average:&emsp;{{ number_format(($tt/$sn),2) }}&emsp; </center></td>
            <td><center>&emsp;Total Average:&emsp;{{ number_format(($av/$sn),2) }}&emsp;</center></td>
        </tr>
        <tr {{ $bod }}>
            <td>
                <center><b>{{ $promotion_status }} </b></center>
            </td>
        </tr>
    </table>

    <div>
        @if ($classn =='JSS1' || $classn =='JSS2' || $classn =='JSS3')
            Grading: 70-100 =A, 60-69.9=B, 50-59.9=C, 40-49.9=P, 0-39.9=F.            
        @else
            Grading: 70-100= A1, 70-79.9= B2, 65-69.9= B3, 60-64.9= C4, 55-59.9= C5, 50-54.9= C6, 45-49.9= D7, 40-44.9= E8, 0-39.9 = F9.          

        @endif

    </div>
    <br>

        <h6>GRADE TEACHER'S REMARKS:&emsp;{{ $gtr }}</h6> <br>
        <h6>PRINCIPAL'S REMARKS:&emsp;{{ $ar }}</h6><br>
 
        <table style='margin-left:0px; font-size:14px;' > 
            <tr>
                <td > <table><tr>
                    <td>Signature </td>
                    <td>&emsp; <img src= "../assets/images/sign/{{ Auth::user()->school_id }}.jpg" alt="Signature" width="50px"/></td>
                </tr>
            <tr>                
                <td>Date </td>
                <td> &emsp;
            @php
               echo date('d/m/Y');
            @endphp    
            </td></tr></table></td>
            </tr>
        </table>
    </center>
    {{-- <br/> --}}
    {{-- <hr/> --}}
  @else
    {{-- {{ __('No result for the selected term') }} --}}

  @endif
</div>
   @endforeach

 @endif

@endif
</x-ux::layouts.page>