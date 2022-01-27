<x-ux::layouts.page :title="__('Payment History')">
    <x-ux::actions search>
        {{-- <x-ux::button icon="plus" :title="__('Create')" click="$emit('showModal', 'schools.save')"/>
        <x-ux::action-dropdown key="sort"/>
        <x-ux::action-dropdown key="filter"/> --}}
    </x-ux::actions>
{{-- {{ dd($schools) }} --}}
    <x-ux::list>
 <center>
        @php
            $acc='\App\Components\Dashboard'::checkaccount()[0]->account_num." (WEMA Bank)";
        @endphp      
        <x-ux::desc :title="__('Subscription Account Details')" :data="$acc"/>
    </center> 
    <br>
        @forelse($schools as $school)
            <x-ux::list-row>
                @php
                    $ref=$school->paymentreference;
                    $created_at = substr($school->created_at, 0, 10);
                    $amount= '₦ '.$school->amount;
                @endphp
            <x-ux::column margin="3">              
                <x-ux::item :data="$school->paymentreference" />
                <x-ux::item :data="$created_at" size="small" color="muted"/>
            </x-ux::column>
                
                <x-ux::column margin="3">
                    <x-ux::item :data="$amount" color="muted"/>
                </x-ux::column>
            </x-ux::list-row>
        @empty
            <option>No payment received yet.</option>
        @endforelse
    </x-ux::list>
    
</x-ux::layouts.page>
