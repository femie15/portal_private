<x-ux::layouts.modal :title="__('Diary')">
    <x-slot name="body">
        <x-ux::desc :title="__('Topic')" :data="'\App\Components\Diaries\Read'::topic($diary->topic_id)[0]"/>
        <x-ux::desc :title="__('Teacher')" :data="'\App\Components\Diaries\Read'::teacher($diary->user_id)[0]"/>
        <x-ux::desc :title="__('Comment')" :data="$diary->name"/>
        <x-ux::desc :title="__('Principal Remarks')" :data="$diary->pid"/>
        <x-ux::desc :title="__('Time Written')" :date="$diary->created_at"/>
        {{-- <x-ux::desc :title="__('Updated At')" :date="$diary->updated_at"/> --}}
            @if ('\App\Components\Diaries\Read'::topic($diary->topic_id)[0]=='NULL')
            <x-ux::button icon="plus" label="Add Lasson Diary" :title="__('Create')" href="{{ url('/diaries') }}"/>                
            @endif
    </x-slot>
     
    <x-slot name="footer">
        <x-ux::button :label="__('Close')" color="secondary" dismiss="modal"/>
    </x-slot>
</x-ux::layouts.modal>
