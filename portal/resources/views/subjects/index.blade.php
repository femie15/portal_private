<x-ux::layouts.page :title="__('Subjects')">
    <x-ux::actions search>
        <x-ux::button icon="plus" :title="__('Create')" click="$emit('showModal', 'subjects.save')"/>
        {{-- <x-ux::action-dropdown key="sort"/>
        <x-ux::action-dropdown key="filter"/> --}}
    </x-ux::actions>
 
    <x-ux::list>
        @foreach($subjects as $subject)
            <x-ux::list-row>
                <x-ux::column margin="3">
                    <x-ux::link :label="$subject->name" click="$emit('showModal', 'subjects.read', {{ $subject->id }})"/>
                    {{-- <x-ux::item :date="$subject->created_at" size="small" color="muted"/> --}}
                </x-ux::column>

                <x-ux::action-column>
                    <x-ux::action icon="eye" :title="__('Read')" click="$emit('showModal', 'subjects.read', {{ $subject->id }})"/>
                    <x-ux::action icon="pencil-alt" :title="__('Update')" click="$emit('showModal', 'subjects.save', {{ $subject->id }})"/>
                    <x-ux::action icon="trash-alt" :title="__('Delete')" click="delete({{ $subject->id }})" confirm/>
                </x-ux::action-column>
            </x-ux::list-row>
        @endforeach
    </x-ux::list>

    <x-ux::pagination :links="$subjects"/>
</x-ux::layouts.page>
