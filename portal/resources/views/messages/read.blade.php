<x-ux::layouts.modal :title="__('Message')">
    <x-slot name="body">
        <x-ux::desc :title="__('ID')" :data="$message->id"/>
        <x-ux::desc :title="__('Name')" :data="$message->name"/>
        <x-ux::desc :title="__('Created At')" :date="$message->created_at"/>
        <x-ux::desc :title="__('Updated At')" :date="$message->updated_at"/>
    </x-slot>

    <x-slot name="footer">
        <x-ux::button :label="__('Close')" color="secondary" dismiss="modal"/>
    </x-slot>
</x-ux::layouts.modal>
