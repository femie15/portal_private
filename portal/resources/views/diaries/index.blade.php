<x-ux::layouts.page :title="__('Lesson Diaries')">
    <x-ux::actions search>
        <x-ux::button icon="plus" :title="__('Create')" click="$emit('showModal', 'diaries.save')"/>
        <x-ux::action-dropdown key="sort"/>
        <x-ux::action-dropdown key="filter"/>
    </x-ux::actions>

    <x-ux::list>
        @foreach($diaries as $diary)
            <x-ux::list-row>
                <x-ux::column margin="3">
                    <x-ux::link :label="'\App\Components\Diaries\Read'::topic($diary->topic_id)[0]" click="$emit('showModal', 'diaries.read', {{ $diary->id }})"/>
                    <x-ux::item :date="$diary->created_at" size="small" color="muted"/>
                </x-ux::column>

                <x-ux::column margin="3">
                    <x-ux::item :data="'\App\Components\Diaries\Read'::teacher($diary->user_id)[0]"/>
                    {{-- <x-ux::link :label="$diary->name" click="$emit('showModal', 'diaries.read', {{ $diary->id }})"/> --}}
                </x-ux::column>

                <x-ux::column margin="3">
                    <x-ux::item :data="$diary->name"/>
                </x-ux::column>

                <x-ux::action-column>
                    <x-ux::action icon="eye" :title="__('Read')" click="$emit('showModal', 'diaries.read', {{ $diary->id }})"/> 
                    <x-ux::action icon="pencil-alt" :title="__('Update')" click="$emit('showModal', 'diaries.save', {{ $diary->id }})"/>
                    {{-- <x-ux::action icon="trash-alt" :title="__('Delete')" click="delete({{ $diary->id }})" confirm/> --}}
                </x-ux::action-column>
            </x-ux::list-row>
        @endforeach
    </x-ux::list>

    <x-ux::pagination :links="$diaries"/>
</x-ux::layouts.page>
