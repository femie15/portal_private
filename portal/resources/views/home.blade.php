<x-ux::layouts.modal :title="__('Live Class')" size="lg ">

<x-slot name="body">
{{-- {{ dd($get_sub) }} --}}

    
@if (Auth::user()->role !="student" && Auth::user()->role !="parent")
    <form action="{{ url('/video/create/index.php') }}" method="post">
        <input type="hidden" name="topic" class="form-control" value="{{ Auth::user()->name }}" required><br>

        <select name="subject" class="form-control" required>
                @if ($get_sub)
                    @foreach($get_sub as $subject)
                        <option value="{{ $subject->name }}">{{ $subject->name }}</option>
                    @endforeach
                @endif
        </select><br>
        
        <select name="classd" class="form-control" required>
            @if ($get_class)
                @foreach($get_class as $cls)
                    <option value="{{ $cls->name }}">{{ $cls->name }}</option>
                @endforeach
            @endif
    </select><br>

        <input type="datetime-local" name="start_date" class="form-control" value="" required><br>
        <input type="number" name="password" class="form-control" placeholder="Set Class Passcode" required><br>  
        <input type="hidden" name="school_id" class="form-control" value="{{ Auth::user()->school_id }}" required> 
    
        <input type="submit" value="Schedule New Class" class="btn btn-primary btn-lg">
    </form>
@endif



<hr width="100%"/> <br>
    
@if (Auth::user()->role !="student" && Auth::user()->role !="parent")
    @if ($get_class)
        @foreach($classed_school as $classlive)
            <a href="{{ $classlive->start_url }}" target="_blank"> 
                <button class='btn btn-primary btn-lg'>START: {{ $classlive->class_id.' '.$classlive->subjects }} Class <br/>Time: {{ $classlive->start_time }}</button>
            </a>
        @endforeach
    @endif

@else   
    @if ($get_class)
        @foreach($classed_school as $classlive)
        @php
            $ju=explode('?pwd=',$classlive->join_url);
            $pas= $ju[1];
            $fr=explode('j/',$ju[0]);
        @endphp
            <form action="{{ url('/video/cdn/index.php') }}" method="post">
                <input type="hidden" name="display_name" value="{{ Auth::user()->name }}">
                <input type="hidden" name="meeting_number" value="{{ $fr[1] }}">
                <input type="hidden" name="meeting_pwd" value="{{ $pas }}">
                <input type="hidden" name="meeting_email" value="{{ Auth::user()->email }}">
                <input type="submit" value="Join: {{ $classlive->class_id.' '.$classlive->subjects }} Class | Time: {{ $classlive->start_time }}" class="btn btn-primary btn-lg">
                {{-- <button  type="submit" class='btn btn-primary btn-lg'>Join: {{ $classlive->class_id.' '.$classlive->subjects }} Class <br/>Time: {{ $classlive->start_time }}</button> --}}
            </form>
        @endforeach
    @endif

@endif


</x-slot>


<x-slot name="footer">
    <x-ux::button :label="__('Cancel')" color="secondary" dismiss="modal"/>
</x-slot>
</x-ux::layouts.modal>