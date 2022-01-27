<x-ux::layouts.page :title="__('Affective Traits Marker')">
    <x-ux::actions search>
        <x-ux::button icon="plus" :title="__('Create')" click="$emit('showModal', 'subjecttraits.save')"/>
        <x-ux::action-dropdown key="sort"/>
        {{-- <x-ux::action-dropdown key="filter"/> --}}
    </x-ux::actions>

    <x-ux::list>
        @foreach($subjecttraits as $subjecttrait)
            <x-ux::list-row>
                <x-ux::column margin="3">
                    <x-ux::link :label="$subjecttrait->name" click="$emit('showModal', 'subjecttraits.read', {{ $subjecttrait->id }})"/>
                    <x-ux::item :date="$subjecttrait->created_at" size="small" color="muted"/>
                </x-ux::column>

                <x-ux::action-column>
                    <x-ux::action icon="eye" :title="__('Read')" click="$emit('showModal', 'subjecttraits.read', {{ $subjecttrait->id }})"/>
                    <x-ux::action icon="pencil-alt" :title="__('Update')" click="$emit('showModal', 'subjecttraits.save', {{ $subjecttrait->id }})"/>
                    <x-ux::action icon="trash-alt" :title="__('Delete')" click="delete({{ $subjecttrait->id }})" confirm/>
                </x-ux::action-column>
            </x-ux::list-row>
        @endforeach
    </x-ux::list>

    <x-ux::pagination :links="$subjecttraits"/>
</x-ux::layouts.page>
