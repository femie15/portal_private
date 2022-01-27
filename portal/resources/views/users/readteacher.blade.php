<x-ux::layouts.modal :title="__('Teacher Biodata')">
    <x-slot name="body">
        {{-- <x-ux::desc :title="__('ID')" :data="$user->id"/> --}}
        <x-ux::desc :title="__('Name')" :data="$user->name"/>
        <x-ux::desc :title="__('Email')" :data="$user->email"/>
        <x-ux::desc :title="__('Login Code')" :data="$user->code"/>
        {{-- <x-ux::desc :title="__('Admission Number')" :data="$user->roll"/> --}}
        <x-ux::desc :title="__('Date of Birth')" :data="$user->birthday"/>
        <x-ux::desc :title="__('Gender')" :data="$user->sex"/>
        <x-ux::desc :title="__('Address')" :data="$user->address"/>
        <x-ux::desc :title="__('Phone Number')" :data="$user->phone"/>
        <x-ux::desc :title="__('Religion')" :data="$user->religion"/>
        {{-- <x-ux::desc :title="__('Class')" :data="$user->class_id"/>
        <x-ux::desc :title="__('Section')" :data="$user->section_id"/>
        <x-ux::desc :title="__('Parent')" :data="$user->parent_id"/> --}}
        <x-ux::desc :title="__('State of origin')" :data="$user->state"/>

        {{-- <x-ux::desc :title="__('Created At')" :date="$user->created_at"/>
        <x-ux::desc :title="__('Updated At')" :date="$user->updated_at"/> --}}
    </x-slot>

    <x-slot name="footer">
        <x-ux::button :label="__('Close')" color="secondary" dismiss="modal"/>
    </x-slot>
</x-ux::layouts.modal>
