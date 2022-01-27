@php
if ($getStudent) {
   $classn= $getStudent[0]->cname;
   $aa= $getStudent[0]->uname.' Midterm Report';

   $sectn= $getStudent[0]->sname;
   $classn= $getStudent[0]->cname;
   $roll= $getStudent[0]->roll;
   $nick= $getStudent[0]->nick_name;
   $gender= $getStudent[0]->gender;
   $stuid= $getStudent[0]->stuid;
}else{ 
    $aa='Midterm Report'; 
   $sectn= '';
   $classn= '';
   $roll='';
   $nick='';
   $gender='';
}
if ($filtr=='') {
    $fil='Select Term and Session';
   $position='';
   $ltposition='';
}else{
    $fil=$filtr;
        $exp=explode(' (',$fil);
        $expt=explode(' T',$exp[1]);
   $position='\App\Components\Results\Midterm'::getposition($exp[0],$expt[0],$stuid);
   
   if ($expt[0]=='1st') {
        $ltposition='\App\Components\Results\Midterm'::getposition($exp[0],$expt[0],$stuid);
   }elseif ($expt[0]=='2nd') {
        $ltposition='\App\Components\Results\Midterm'::getposition($exp[0],'1st',$stuid);
   }else{
        $ltposition='\App\Components\Results\Midterm'::getposition($exp[0],'2nd',$stuid);
   }
}
$view_position='\App\Components\Schools\Read'::seeposition();
$promotion_status='';
$ft=$sc=$tt=$sn=$av=0;
@endphp
<x-ux::layouts.page :title="__($aa)">
    <center>
        <x-ux::action-dropdown key="filter" label="{{ $fil }}" icon="calendar"/>
    </center>
{{-- !$filtr ? __('Select Term and Session') : $filtr--}}
   
@if ($results && (count($results)>0))  

                    @php           
                    $path_to_file ='assets/images/users/'.$results[0]->student_id.'.jpg';     
                    @endphp 
                        @if (File::exists(public_path($path_to_file)))
                            <x-ux::image asset="{{ $path_to_file }}" width="120px" height="120px" style="float:right; margin-top:15px; margin-right:10px; border-radius:15px;"/>
                        @else
                            <x-ux::action icon="user fa-6x" :title="__('Add Image')" click="$emit('showModal', 'users.save', {{ $results[0]->student_id }})" width="120px" height="120px" style="float:right; margin-top:15px; margin-right:10px; border-radius:15px;"/>
                        @endif
<br>

<style>
    .table-resp {
    /* display: block; */
    width: 65%;
    overflow-x: auto;
}

.table-respo {
    /* display: block; */
    width: 100%;
    overflow-x: auto;
}
</style>

<table class="table table-stripped table-resp" style="font-size: 12px;font-weight: 500;">
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
<table width="95%" class="table table-stripped table-bordered table-respo"  style='font-weight: 700; font-size:18px;'>
        <tr><h4><b>COGNITIVE SKILL (ACADEMIC)</b></h4></tr>
    <tr  width="100%">																		
        <tr>
        <th rowspan="3"><div width="30px"><center>SUBJECTS</center></div></th>
        <th colspan="4"><div><center> C.A.</center></div></th>
        {{-- <th rowspan="2"><div class="rotate"> EXAM <br>Marks</div></th> --}}
        <th rowspan="2"><div class="rotate"> &emsp;Total<br> &emsp;Score</div></th>
        {{-- <th rowspan="3"><div class="rotate"><center>CLASS <br>AVERAGE</center></div></th> --}}
        <th rowspan="3"><div class="rotate"> GRADE</div></th>
        <th rowspan="3"><div class="rotate"> REMARKS</div></th>			
        @if ($view_position=='Yes')
            <th rowspan="3"><div class="rotate"> POSITION</div></th>            
        @endif					
        {{-- <th colspan="4"><div><center>YEAR SUMMARY</center></div></th>	              --}}
        </tr>

        <tr>
            <td color="black"><center>ASSIGNMENT 1</center></td>
            <td class="rotate" height="0"> <center>ASSIGNMENT 2</center></td>
            <td class="rotate"> TEST 1</td>
            <td class="rotate"> TEST 2</td>
            {{-- <td class="rotate" rowspan="2"> 1st Term </td>
            <td class="rotate" rowspan="2"> 2nd Term </td>
            <td class="rotate" rowspan="2"> 3rd Term </td> 
            <td class="rotate" rowspan="2"> Ave Score</td>            --}}
        </tr>

        @if ($classn =='JSS1' || $classn =='JSS2' || $classn =='JSS3')
            <td><center> 10 </center></td>
            <td><center>10 </center></td>
            <td><center>20 </center></td>
            <td><center> 20 </center></td>
            <td><center> 60 </center></td>
        @else
            <td><center> 5 </center></td>
            <td><center>5 </center></td>
            <td><center>10 </center></td>
            <td><center>10 </center></td>
            <td><center>30 </center></td>

        @endif

    </tr>

         @foreach($results as $result)   
   
    @if($result->total > 0)
    
               
@php
$sum=$result->ca1+$result->ca2+$result->text1+$result->text2;
if ($result->exam && $result->exam >=1) {
    if ($classn =='JSS1' || $classn =='JSS2' || $classn =='JSS3') {
        $sum=($sum/60)*100;
    }else {
        $sum=($sum/30)*100;
    }
}

$firstterm='\App\Components\Results\midterm'::termly($result->student_id,'1st',$result->session,$result->subject_id);
$secondterm='\App\Components\Results\midterm'::termly($result->student_id,'2nd',$result->session,$result->subject_id);
$thirdterm='\App\Components\Results\midterm'::termly($result->student_id,'3rd',$result->session,$result->subject_id);
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
            {{-- <td><center> {{ $result->text2 }} </center></td>
            <td><center> {{ $result->exam }} </center></td> --}}
            <td><center> {{ $sum }} </center></td>
            {{-- <td><center> {{ '\App\Components\Results\midterm'::clavg($result->term,$result->session,$result->subject_id,$result->class_id,$result->section_id) }} </center></td> --}}
            
        @if ($classn =='JSS1' || $classn =='JSS2' || $classn =='JSS3')
            <td><center>{{ '\App\Components\Results\Midterm'::gradej($sum)['grade'] }} </center></td>
           <td><center>{{ '\App\Components\Results\Midterm'::gradej($sum)['remark'] }}</center></td>                
        @else
            <td><center>{{ '\App\Components\Results\Midterm'::grade($sum)['grade'] }} </center></td>
            <td><center>{{ '\App\Components\Results\Midterm'::grade($sum)['remark'] }}</center></td>                
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
        
        
            {{-- <td><center>
                {{ $firstterm }}
                </center></td>
            <td><center>
                {{ $secondterm }}
            </center></td>
            <td><center>                
                {{ $thirdterm}}
            </center></td>

            <td><center> {{ $avgscore }}</center></td> --}}
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
                //Teacher and Principal's Remark
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
                //Teacher and Principal's Remark
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
    {{-- <table class="table table-stripped">
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
    </table> --}} <br>
<table class="table table-stripped" style="font-size: 14px;">
    <tr>
        @if ($oneq)
            <td rowspan="2"><center>&emsp;1st term Average:&emsp;{{ number_format(($ft/$sn),2)}}&emsp;</center></td>
         @elseif ($towq)    
            <td rowspan="2"><center>&emsp;2nd term Average:&emsp;{{ number_format(($sc/$sn),2) }}&emsp;</center></td>
         @elseif ($thrq)    
            <td rowspan="2"><center>&emsp;3rd term Average:&emsp;{{ number_format(($tt/$sn),2) }}&emsp; </center></td>
         @else 
            <!--$dv=1;-->
         @endif

        {{-- <td><center>&emsp;Total Average:&emsp;{{ number_format(($av/$sn),2) }}&emsp;</center></td> --}}
    </tr>
</table>
<br>

        <h5>GRADE TEACHER'S REMARKS:&emsp;{{ $gtr }}</h5> <br>
        <h5>PRINCIPAL'S REMARKS:&emsp;{{ $ar }}</h5><br>


    {{-- dd($getTerm[0]['end']-$getTerm[0]['start']); --}}

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
@else
{{ __('No result for the selected term') }}
@endif

    {{-- <x-ux::pagination :links="$results"/> --}}
</x-ux::layouts.page>
