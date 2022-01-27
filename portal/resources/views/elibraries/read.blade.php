<x-ux::layouts.modal :title="__('Elibrary')">
    <x-slot name="body">
        {{-- <x-ux::desc :title="__('ID')" :data="$elibrary->id"/> --}}
        <x-ux::desc :title="__('Name')" :data="$elibrary->name"/>
        <x-ux::desc :title="__('Created At')" :date="$elibrary->created_at"/>
        {{-- <x-ux::desc :title="__('Updated At')" :date="$elibrary->updated_at"/> --}}
    </x-slot>
 
    <x-slot name="footer">
        <x-ux::button :label="__('Close')" color="secondary" dismiss="modal"/>
    </x-slot>
</x-ux::layouts.modal>
