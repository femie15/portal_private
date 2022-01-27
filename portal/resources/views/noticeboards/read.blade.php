<x-ux::layouts.modal :title="__('Noticeboard')">
    <x-slot name="body">
        <x-ux::desc :title="__('Title')" :data="$noticeboard->notice_title"/>
        <x-ux::desc :title="__('Information')" :data="$noticeboard->notice"/>
        <x-ux::desc :title="__('Date')" :data="date('d M,Y',$noticeboard->created_timestamp)"/>
    </x-slot>

    <x-slot name="footer">
        <x-ux::button :label="__('Close')" color="secondary" dismiss="modal"/>
    </x-slot>
</x-ux::layouts.modal>
