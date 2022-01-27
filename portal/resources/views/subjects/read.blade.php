<x-ux::layouts.modal :title="__('Subject')">
    <x-slot name="body">
        {{-- <x-ux::desc :title="__('ID')" :data="$subject->id"/> --}}
        <x-ux::desc :title="__('Name')" :data="$subject->name"/>
        {{-- <x-ux::desc :title="__('Created At')" :date="$subject->created_at"/>
        <x-ux::desc :title="__('Updated At')" :date="$subject->updated_at"/> --}}
    </x-slot>

    <x-slot name="footer">
        <x-ux::button :label="__('Close')" color="secondary" dismiss="modal"/>
    </x-slot>
</x-ux::layouts.modal>
