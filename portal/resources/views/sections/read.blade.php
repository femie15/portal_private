<x-ux::layouts.modal :title="__('Section')">
    <x-slot name="body">
        {{-- <x-ux::desc :title="__('ID')" :data="$section->id"/> --}}
        <x-ux::desc :title="__('Name')" :data="$section->name"/>
        {{-- <x-ux::desc :title="__('Created At')" :date="$section->created_at"/>
        <x-ux::desc :title="__('Updated At')" :date="$section->updated_at"/> --}}
    </x-slot>

    <x-slot name="footer">
        <x-ux::button :label="__('Close')" color="secondary" dismiss="modal"/>
    </x-slot>
</x-ux::layouts.modal>
