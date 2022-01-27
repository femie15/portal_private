<x-ux::layouts.modal :title="!$noticeboard->exists ? __('Create Noticeboard') : __('Update Noticeboard')" submit="save">
    <x-slot name="body">
        <x-ux::input :label="__('Title')" model="notice_title"/>
        <x-ux::textarea :label="__('Information')" model="notice"/>
        <x-ux::input :label="__('Date')" type="date" model="created_timestamp"  class="datepicker" min="{{ date('Y-m-d') }}" placeholder="2022-01-01"/>
    </x-slot>

    <x-slot name="footer">
        <x-ux::button :label="__('Cancel')" color="secondary" dismiss="modal"/>
        <x-ux::button :label="__('Save')" type="submit"/>
    </x-slot>
</x-ux::layouts.modal>
