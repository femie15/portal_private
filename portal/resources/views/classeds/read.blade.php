<x-ux::layouts.modal :title="__('Classed')">
    <x-slot name="body">
        {{-- <x-ux::desc :title="__('ID')" :data="$classed->id"/> --}}
        <x-ux::desc :title="__('Name')" :data="$classed->name"/>
        <x-ux::desc :title="__('Created At')" :date="$classed->created_at"/>
        {{-- <x-ux::desc :title="__('Updated At')" :date="$classed->updated_at"/> --}}
    </x-slot>

    <x-slot name="footer">
        <x-ux::button :label="__('Close')" color="secondary" dismiss="modal"/>
    </x-slot>
</x-ux::layouts.modal>
