<x-ux::layouts.modal :title="!$school->exists ? __('Customized Settings') : __('Update School Settings')" submit="save">
    <x-slot name="body">
        <x-ux::input :label="__('School Name')" model="name" disabled/>        
{{-- @php 
if ('\App\Components\Dashboard'::checkaccount() !='' || '\App\Components\Dashboard'::checkaccount() !=[]) {
    $acc='\App\Components\Dashboard'::checkaccount()[0]->account_num." (WEMA Bank)";
}else {    
    $acc="No account opened yet";
}
@endphp
        <x-ux::desc :title="__('Subscription Account Details')" :data="$acc"/>
        
        <x-ux::action icon="eye" label="View Payment history" href="{{ url('/payhistory') }}"/> --}}
        
    @if (Auth::user()->id == '1')
        <x-ux::input :label="__('Contact Person')" model="school_id"/>            
    @endif
        {{-- <x-ux::input :label="__('School Email')" model="web"/> --}}
        <x-ux::input :label="__('School Website')" model="web"/>
        <x-ux::selectcolor :label="__('School Colour')" placeholder="Select Colour" :options="['default'=>'Default', 'purple'=>'Purple', 'white'=>'White', 'black'=>'Black', 'red'=>'Red', 'green'=>'Green', 'blue'=>'Blue','cafe'=>'Cafe','yellow'=>'Yellow']" model="colour"/>
        <x-ux::select :label="__('View Student Position')" :options="['0'=>'Yes', '1'=>'No']" model="view_position"/>
    </x-slot>

    <x-slot name="footer">
        <x-ux::button :label="__('Cancel')" color="secondary" dismiss="modal"/>
        <x-ux::button :label="__('Save')" type="submit"/>
    </x-slot>
</x-ux::layouts.modal>
