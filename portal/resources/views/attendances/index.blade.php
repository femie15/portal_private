<x-ux::layouts.page :title="__('Attendance')">
    @php
        if ($filtr=='') {
    $fil='Select Class';
    }else{
        $fil=$filtr;
    }
    @endphp
        <center>
            <x-ux::action-dropdown key="filter" icon="graduation-cap" label="{{ $fil }}"/>
            <br/>
        </center>

    @foreach($getSection as $resulta)
                @foreach ($getClass as $key => $name)
                    @if ($resulta->class_id == $name)
                        @php                        
                            session(['classid'=>$resulta->class_id]);
                        @endphp
                        <x-ux::link icon="graduation-cap" :title="$resulta->name" label="{{ $key }}{{ $resulta->name }} ({{ $resulta->nick_name }})" class="btn btn-primary btn-sm" href="{{ url('/attendances') }}/{{ $resulta->id }}"/>
                    @endif
                @endforeach
            @endforeach

@if (isset($_GET['success']) && $_GET['success']=='yes')   
    <x-ux::alert :label="__('Recorded successfully')"/>
@endif

@if ($getStudent)

        {{-- {{ dd($getStudent) }} --}}
<br><br>
    <x-ux::list>   
        <form action="{{ url('/att') }}" method="POST">
            @csrf

        @foreach($getStudent as $key => $name)
        {{-- {{ dd($name->name) }} --}}
            <x-ux::list-row>
                <x-ux::column margin="3">
                    <x-ux::item :data="$name->name" style="font-weight:700; color:blue; font-size:14px; "/>
                    {{-- <x-ux::item :date="$attendance->created_at" label="Date" size="small" color="muted"/> --}}
                </x-ux::column>
                @php
                    $wowa='\App\Components\Attendances\index'::getAtt($name->id, date('Y-m-d'));
                    // dd($wowa);
                    if ($name->id == $wowa) {
                    // dd($wowa);
                        $che="checked";
                    }else {                        
                        $che="";
                    }                    
                @endphp

                <x-ux::column margin="3">
                    {{-- <x-ux::check :checkLabel="__('Present')" model="name{{ $name->name }}" name="att[]" checked/> --}}
                        {{-- <input type="checkbox" id="{{ $name->name }}" value="{{ $name->name }}" name="att[]" class="btn btn-primary" {{ $che }}/><label for="{{ $name->name }}" class="switch">Present</label>  --}}
                        
                        <input type="checkbox" value="{{ $name->id }}" name="name[]" data-bootstrap-switch data-off-color="danger" data-on-color="success"   {{ $che }}>

                </x-ux::column>

                {{-- <x-ux::action-column>
                    <x-ux::action icon="eye" :title="__('Read')" click="$emit('showModal', 'attendances.read', {{ $attendance->id }})"/>
                    <x-ux::action icon="pencil-alt" :title="__('Update')" click="$emit('showModal', 'attendances.save', {{ $attendance->id }})"/>
                    <x-ux::action icon="trash-alt" :title="__('Delete')" click="delete({{ $attendance->id }})" confirm/>
                </x-ux::action-column> --}}
            </x-ux::list-row>
        @endforeach
    </x-ux::list>
    <center>
            <button type="submit" class="btn btn-primary btn-lg">Submit Attendance</button>
        </center>
</form>
@endif
    {{-- <x-ux::pagination :links="$attendances"/> --}}
</x-ux::layouts.page>
