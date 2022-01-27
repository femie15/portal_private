<x-ux::layouts.modal :title="__('Term')">
    <x-slot name="body">
        {{-- <x-ux::desc :title="__('ID')" :data="$term->id"/> --}}
        <x-ux::desc :title="__('Term')" :data="$term->name"/>
        <x-ux::desc :title="__('Session')" :data="$term->session"/>
            <x-ux::desc :title="__('Start Date')" :data="$term->start_date"/>
                <x-ux::desc :title="__('End Date')" :data="$term->end_date"/>
        {{-- <x-ux::desc :title="__('Created At')" :date="$term->created_at"/>
        <x-ux::desc :title="__('Updated At')" :date="$term->updated_at"/> --}}
    </x-slot>

    <x-slot name="footer">
        <x-ux::button :label="__('Close')" color="secondary" dismiss="modal"/>
    </x-slot>
</x-ux::layouts.modal>
