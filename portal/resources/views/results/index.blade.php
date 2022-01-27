<x-ux::layouts.page :title="__('Results')">
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        } 
        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style> 

        <center>
        <x-ux::action-dropdown key="filter" icon="graduation-cap" label="Select Class"/>
        <br/>
    </center>

    {{-- <x-ux::action icon="table fa-6x" :title="__('Tabulation Sheet')" href="{{ url('/tabulation/0') }}" width="90px" height="90px" style="float:right; margin-top:15px; margin-right:10px;"/> --}}
<br/>

@if ($getSection && count($getSection)>0)
            @forelse($getSection as $resulta)
                @foreach ($getClass as $key => $name)
                    @if ($resulta->class_id == $name)
                        @php                        
                            session(['classid'=>$resulta->class_id]);
                            
                            session(['classn'=>$key]);                            
                        @endphp
                        <x-ux::link icon="graduation-cap" :title="$resulta->name" label="{{ $key }}{{ $resulta->name }} ({{ $resulta->nick_name }})" class="btn btn-primary btn-sm" href="{{ url('/results') }}/{{ $resulta->id }}"/>
                    @endif
                @endforeach
            @empty
                <a href="{{ url('/sections') }}">Add Class Sections.</a> 
            @endforelse
@endif
            
@if (isset($_GET['success']) && $_GET['success']=='yes')   
    <x-ux::alert :label="__('Recorded successfully')"/>
@endif

        @if ($getSubject)  
        @foreach ($getSubject as $key => $name)
            @if ($hd==$name)
                <x-ux::link icon="book" :title="$key" label="{!! $key !!}" class="btn btn-success btn-sm" style="margin-bottom: 5px;" href="?view={{ $name }}"/>            
                @php                        
                    session(['sb'=>$name]);
                    session(['suj'=>$key]);
                @endphp
            @else
                <x-ux::link icon="book" :title="$key" label="{!! $key !!}" class="btn btn-primary btn-sm" style="margin-bottom: 5px;" href="?view={{ $name }}"/>
            @endif
        @endforeach
        @endif

        @if ($getStudent)
    <x-ux::list>           
        @if (session()->get('classid')=='' || session()->get('term')=='' || session()->get('sess')=='')
            @php
                redirect('/results/0');
            @endphp 
        @endif

        <div {{ $hd }}>
            <center><h2>Marks ({{session()->get('term').'Term '.session()->get('sess').' Session' }})</h2></center>

            
            &emsp;<x-ux::link icon="upload" label="Upload Excel / CSV" class="btn btn-warning btn-sm" href="{{ url('/import') }}"/>
    
       

<form action="{{ url('/score') }}" method="POST">
@csrf
@php
    $ca1=0;
    $ca2=0;
    $text1=0;
    $text2=0;
    $exam=0;   
@endphp

        @forelse($getStudent as $key => $name)
            @if ($results)
                @foreach($results as $keyz => $namez) 
                    @php  
                        if ($namez->student_id==$name){
                            $ca1=$namez->ca1;
                            $ca2=$namez->ca2;
                            $text1=$namez->text1;
                            $text2=$namez->text2;
                            $exam=$namez->exam;
                        }
                    @endphp   
                @endforeach            
            @endif

            <x-ux::list-row>
                <x-ux::column margin="3">
                    <x-ux::item :data="$key" style="font-weight:700; color:blue; font-size:14px; "/>
                </x-ux::column>
                    
            <input type="hidden" value="{{ $name }}" name="name[]" required/>
            <input type="hidden" value="{{ session()->get('sectid') }}" name="section" required/>
            <input type="hidden" value="{{ session()->get('classid') }}" name="class" required/>
            <input type="hidden" value="{{ $hd }}" name="sub" required/>

                <x-ux::column margin="3">         
                    <label for="">{{ __('Assignment') }}</label>      
                    <input type="number" value="{{ $ca1 }}" min="0" max="10" step="any" id="ca1_{{ $name }}" name="ca1[]" oninput="findTotal_{{ $name }}()" class="form-control"/>
                </x-ux::column>
                <x-ux::column margin="3">         
                    <label for="">{{ __('CA') }}</label>                     
                    <input type="number" value="{{ $ca2 }}" min="0" max="10" step="any" id="ca2_{{ $name }}" name="ca2[]" oninput="findTotal_{{ $name }}()" class="form-control"/>
                </x-ux::column>
                <x-ux::column margin="3">         
                    <label for="">{{ __('Test 1') }}</label>                     
                    <input type="number" value="{{ $text1 }}" min="0" max="20" step="any" id="text1_{{ $name }}" name="text1[]" oninput="findTotal_{{ $name }}()" class="form-control"/>
                </x-ux::column>
                <x-ux::column margin="3">         
                    <label for="">{{ __('Test 2') }}</label>                     
                    <input type="number" value="{{ $text2 }}" min="0" max="20" step="any" id="text2_{{ $name }}" name="text2[]" oninput="findTotal_{{ $name }}()" class="form-control"/>
                </x-ux::column>
                <x-ux::column margin="3">         
                    <label for="">{{ __('Exam') }}</label>                     
                    <input type="number" value="{{ $exam }}" min="0" max="60" step="any" id="exam_{{ $name }}" name="exam[]" oninput="findTotal_{{ $name }}()" class="form-control"/>
                </x-ux::column>
                <x-ux::column margin="3">         
                    <label for="">{{ __('Total') }}</label>                     
                    <input type="number" class="form-control" id="total_{{ $name }}" disabled/>
                    <input type="hidden"  name="totalup[]" id="totalup_{{ $name }}"/>
                </x-ux::column>
            </x-ux::list-row>

            <script>
                document.getElementById('totalup_{{ $name }}').value =0;
                function findTotal_{{ $name }}() {
                    var ca1_{{ $name }} = document.getElementById('ca1_{{ $name }}');
                    var ca2_{{ $name }} = document.getElementById('ca2_{{ $name }}');
                    var text1_{{ $name }} = document.getElementById('text1_{{ $name }}');
                    var text2_{{ $name }} = document.getElementById('text2_{{ $name }}');
                    var exam_{{ $name }} = document.getElementById('exam_{{ $name }}');
                    var sum_{{ $name }} = 0;
                    
                    sum_{{ $name }}= Number(ca1_{{ $name }}.value)+Number(ca2_{{ $name }}.value)+Number(text1_{{ $name }}.value)+Number(text2_{{ $name }}.value)+Number(exam_{{ $name }}.value);
                    document.getElementById('total_{{ $name }}').value =sum_{{ $name }} ;
                    document.getElementById('totalup_{{ $name }}').value =sum_{{ $name }} ;
                }    
                
                    var ca1_{{ $name }} = document.getElementById('ca1_{{ $name }}');
                    var ca2_{{ $name }} = document.getElementById('ca2_{{ $name }}');
                    var text1_{{ $name }} = document.getElementById('text1_{{ $name }}');
                    var text2_{{ $name }} = document.getElementById('text2_{{ $name }}');
                    var exam_{{ $name }} = document.getElementById('exam_{{ $name }}');
                    var sum_{{ $name }} = 0;
                    
                    sum_{{ $name }}= Number(ca1_{{ $name }}.value)+Number(ca2_{{ $name }}.value)+Number(text1_{{ $name }}.value)+Number(text2_{{ $name }}.value)+Number(exam_{{ $name }}.value);
                    document.getElementById('total_{{ $name }}').value =sum_{{ $name }} ;
                    document.getElementById('totalup_{{ $name }}').value =sum_{{ $name }} ;
            </script>
        @empty
        <br>
            <a href="{{ url('/student') }}">Add students to class section</a>
        @endforelse

<center>

        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
    </center>
</form>
        </div>
         </x-ux::list>
        @endif
</x-ux::layouts.page>
