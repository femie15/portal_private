<x-ux::layouts.modal :title="!$term->exists ? __('Create New Term') : __('Update Term')" submit="save">
    @php
     $tm=$ses= array();
        
    @endphp
    <x-slot name="body">
        {{-- <x-ux::input :label="__('Term')" model="name"/> --}}
        <x-ux::select :label="__('Term')" :options="['1st', '2nd', '3rd']" model="name" class="form-control"/>

        {{-- <x-ux::input :label="__('Session')" model="session"/> --}}
        <x-ux::select :label="__('Session')" :options="['2021/2022', '2022/2023', '2023/2024']" model="session" class="form-control"/>

        <x-ux::input :label="__('Start Date')" model="start_date" type="date"/>
        <x-ux::input :label="__('End Date')" model="end_date" type="date"/>
    </x-slot>

    <x-slot name="footer">
        <x-ux::button :label="__('Cancel')" color="secondary" dismiss="modal"/>
        <x-ux::button :label="__('Save')" type="submit"/>
    </x-slot> 
</x-ux::layouts.modal>