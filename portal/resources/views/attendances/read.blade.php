<x-ux::layouts.modal :title="__('Attendance')">
    <x-slot name="body">
        {{-- <x-ux::desc :title="__('ID')" :data="$attendance->id"/> --}}
        <x-ux::desc :title="__('Name')" :data="'\App\Components\Attendances\Read'::getParent($attendance->name)"/>
        <x-ux::desc :title="__('Marked At')" :date="$attendance->created_at"/>
        {{-- <x-ux::desc :title="__('Updated At')" :date="$attendance->updated_at"/> --}}
    </x-slot>

    <x-slot name="footer">
        <x-ux::button :label="__('Close')" color="secondary" dismiss="modal"/>
    </x-slot>
</x-ux::layouts.modal>
