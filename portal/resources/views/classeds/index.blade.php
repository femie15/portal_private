<x-ux::layouts.page :title="__('Classeds')">
    <x-ux::actions search>
        <x-ux::button icon="plus" :title="__('Create')" click="$emit('showModal', 'classeds.save')"/>
        <x-ux::action-dropdown key="sort"/>
        <x-ux::action-dropdown key="filter"/>
    </x-ux::actions>
{{ $classeds }}
    <x-ux::list> 
        @foreach($classeds as $classed)
            <x-ux::list-row>
                <x-ux::column margin="3">
                    <x-ux::link :label="$classed->name" click="$emit('showModal', 'classeds.read', {{ $classed->id }})"/>
                    <x-ux::item :date="$classed->created_at" size="small" color="muted"/>
                </x-ux::column>

                <x-ux::action-column>
                    <x-ux::action icon="eye" :title="__('Read')" click="$emit('showModal', 'classeds.read', {{ $classed->id }})"/>
                    <x-ux::action icon="pencil-alt" :title="__('Update')" click="$emit('showModal', 'classeds.save', {{ $classed->id }})"/>
                    <x-ux::action icon="trash-alt" :title="__('Delete')" click="delete({{ $classed->id }})" confirm/>
                </x-ux::action-column>
            </x-ux::list-row>
        @endforeach
    </x-ux::list>

    <x-ux::pagination :links="$classeds"/>
</x-ux::layouts.page>
