<x-ux::layouts.modal :title="__('Subjecttrait')">
    <x-slot name="body">
        <x-ux::desc :title="__('ID')" :data="$subjecttrait->id"/>
        <x-ux::desc :title="__('Name')" :data="$subjecttrait->name"/>
        <x-ux::desc :title="__('Created At')" :date="$subjecttrait->created_at"/>
        <x-ux::desc :title="__('Updated At')" :date="$subjecttrait->updated_at"/>
    </x-slot>

    <x-slot name="footer">
        <x-ux::button :label="__('Close')" color="secondary" dismiss="modal"/>
    </x-slot>
</x-ux::layouts.modal>
