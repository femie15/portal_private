@php
if ($getStudent) {
   $classn= $getStudent[0]->cname;
   $aa= $getStudent[0]->uname.' Marksheet ('.$classn.')';
   $sectn= $getStudent[0]->sname;
   $classn= $getStudent[0]->cname.' Tabulation Sheet';
   $roll= $getStudent[0]->roll;
   $nick= $getStudent[0]->nick_name;
}else{ 
    $aa='Marksheet'; 
   $sectn= '';
   $classn= '';
   $roll='';
   $nick='';
}
if ($filtr=='') {
    $fil='Select Term and Session';
}else{
    $fil=$filtr;
}

if ($sort=='') {
    $sot='Select Class';
}else{
    $sot=$sort;
}

$promotion_status='';
$ft=$sc=$tt=$sn=$av=0;
$ar=[];

//process term and session
if ($filtr && $filtr!=''){
    $ses=explode(' (',$this->getModel('filter'));
    $tem=explode(' T',$ses[1]);
}
@endphp

<x-ux::layouts.page :title="__($classn)">
    <center> 
        <x-ux::action-dropdown key="sort" label="{{ $sot }}" icon="graduation-cap"/>
        <x-ux::action-dropdown key="filter" label="{{ $fil }}" icon="calendar"/>
    <br> <br>
    <span style="background-color: rgb(245, 231, 231);">1st Term</span>
    <span style="background-color: rgb(150, 204, 240);">2nd Term</span>
    <span style="background-color: rgb(175, 247, 184);">3rd Term</span>
    <span style="background-color: rgb(255, 255, 255);">Total</span>
</center>

@if ($getStudent && (count($getStudent)>0))
    {{ count($getStudent) }} Student(s)

    <table width="95%" class="table table-responsive table-stripped table-bordered">
        <tr>
            <th><h5><b>Name</b></h5></th>
            <th><b>Roll Number</b></th>
            <th><b>Section</b></th>            
          @if ($results && (count($results)>0))  
            @foreach($results as $result) 
                @php
                    array_push($ar, $result->subject[0]->id);
                @endphp
                <th colspan="4"><center><b> {{ $result->subject[0]->name }}</b></center></th>
            @endforeach            
          @endif
        </tr>


        @foreach($getStudent as $stud)
 
              <tr>
                <td>{{ $stud->uname }}</td>
                <td>{{ $stud->roll }}</td>
                <td>{{ $stud->nick_name }}</td>

            @if ($ar && (count($ar)>0)) 
                @foreach($ar as $ary)
            
                    {{-- @if ($results && (count($results)>0))  
                        @foreach($results as $result)
                            @if ($result->subject[0]->id == $ary) --}}
@php
$firstterm='\App\Components\Results\tabulation'::termly($stud->uid,'1st',$ses[0],$ary);
$secondterm='\App\Components\Results\tabulation'::termly($stud->uid,'2nd',$ses[0],$ary);
$thirdterm='\App\Components\Results\tabulation'::termly($stud->uid,'3rd',$ses[0],$ary);
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
@endphp                           


                                <td style="background-color: rgb(245, 231, 231);">{{ $firstterm }}</td>
                                <td style="background-color: rgb(150, 204, 240);">{{ $secondterm }}</td>
                                <td style="background-color: rgb(175, 247, 184);">{{ $thirdterm }}</td>
                                <td><b>{{ $avgscore }}</b></td>
                            {{-- @endif 
                        @endforeach
                    @endif --}}
                @endforeach
            @endif

            </tr>

        @endforeach
    </table>

@else
<br>
    {{ __('Select Class and Term') }}
@endif

    {{-- <x-ux::pagination :links="$results"/> --}}
</x-ux::layouts.page>
