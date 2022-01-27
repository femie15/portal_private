<x-ux::layouts.modal :title="!$diary->exists ? __('Create Diary') : __('Update Diary')" submit="save">
    <x-slot name="body">
        <x-ux::input :label="__('Topic')" model="topic_id"/>
        {{-- <x-ux::input :label="__('Teacher')" model="user_id"/> --}}
        <x-ux::input :label="__('Comment')" model="name"/>
        <x-ux::input :label="__('Principal Remark')" model="pid"/>
    </x-slot>

    <x-slot name="footer">
        <x-ux::button :label="__('Cancel')" color="secondary" dismiss="modal"/>
        <x-ux::button :label="__('Save')" type="submit"/>
    </x-slot>
</x-ux::layouts.modal>
