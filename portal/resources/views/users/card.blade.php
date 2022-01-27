<x-ux::layouts.page :title="__('Student Access Card')">
    {{-- <x-ux::actions search>
    </x-ux::actions> --}}
 {{-- {{ dd($getStudent) }} --}}
 <br><br><br>
 <style>
    div {
        float: left;
        font-family: courier;
        size: 8px;
    }
    #sch {
        position: absolute;
        margin-top: -162px;
        /* margin-left: 40px; */
        font-size:7px;
    }
    #pn {
        position: absolute;
        margin-top: -93px;
        margin-left: 210px;
        font-size:20px;
    }
    #sr {
        position: absolute;
        margin-top: -71px;
        margin-left: 210px;
        font-size:20px;
    }
    #who {
        position: absolute;
        margin-top: -147px;
        margin-left: 20px;
        font-size:15px;
    }
    #dt {
        position: absolute;
        margin-top: -84px;
        margin-left: 20px;
        font-size:15px;
    }
    #test {
        position: absolute;
        margin-top: -24px;
        margin-left: 3px;
        font-size:9px;
    }
</style>



@if ($getClass && count($getClass)>0)       
    
        @forelse ($getClass as $key => $name)
            <x-ux::link icon="graduation-cap" :title="$key" label="{{ $key }}" class="btn btn-primary btn-sm" href="/card/{{ $key }}"/>
        @empty
                <a href="{{ url('/classeds') }}">kindly add classes</a>
        @endforelse
@endif

        <x-ux::list>
<br><br>
<div>
    @if ($getStudent && count($getClass)>0)      
        @forelse($getStudent as $user) 
        {{-- {{ dd($user) }} --}}
        <div style="width:315px; height:205px; border: 1px solid rgb(235, 34, 34);  page-break-inside: avoid; margin-right:5px; margin-bottom:5px;">
				<img src="../assets/images/card.jpg" width="100%" height="100%" >
				<div id="pn" style="width:150px;"><b>{{ $user->code }}</b></div>
				<div id="sr"><b>{{ __('1000') }}</b></div>
				<div id="who" style="width:300px;"><br/><b>{{ $user->name }}</b></div>
				<div id="dt"><b>{{ $user->roll }}</b></div>
        @empty
                <a href="{{ url('/students') }}">kindly add Students</a>
        @endforelse
    @endif
</div>   
    
</x-ux::list>
</x-ux::layouts.page>