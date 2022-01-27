<x-ux::layouts.modal :title="__('School')">
    <x-slot name="body">
        @if ('\App\Components\Users\Read'::getUser($school->school_id)['other']=='')
        <x-ux::desc :title="__('Name')" :data="__('N/A')"}/>
            @else
            <x-ux::desc :title="__('Name')" :data="'\App\Components\Users\Read'::getUser($school->school_id)['other']->name"/>
        @endif 
        {{-- @php
            $acc='\App\Components\Dashboard'::checkaccount()[0]->account_num." (WEMA Bank) ";
        @endphp
        
        <x-ux::desc :title="__('Subscription Account Details')" :data="$acc"/>
        <x-ux::action icon="eye" label="View Payment history" href="{{ url('/payhistory') }}"/> --}}

        <x-ux::desc :title="__('Contact Person')" :data="'\App\Components\Users\Read'::getUser($school->school_id)['em']"/>
        <x-ux::desc :title="__('School website')" :data="$school->web"/>
            
        @if ('\App\Components\Users\Read'::getUser($school->school_id)['other']=='')
            <x-ux::desc :title="__('School Email')" :data="__('N/A')"/>
        @else
            <x-ux::desc :title="__('School Email')" :data="'\App\Components\Users\Read'::getUser($school->school_id)['other']->email"/>
        @endif

        <div style="background-color: {{ $school->colour }}; color:#fff;">School Colour</div>
        {{-- <x-ux::desc :title="__('Created At')" :date="$school->created_at"/>
        <x-ux::desc :title="__('Updated At')" :date="$school->updated_at"/> --}}
    </x-slot>

    <x-slot name="footer">
        <x-ux::button :label="__('Close')" color="secondary" dismiss="modal"/>
    </x-slot>
</x-ux::layouts.modal>



                        