<x-ux::layouts.page :title="__('Terms')">
    <x-ux::actions search>
        <x-ux::button icon="plus" :title="__('Create')" click="$emit('showModal', 'terms.save')"/>
        <x-ux::action-dropdown key="sort"/>
        {{-- <x-ux::action-dropdown key="filter"/> --}}
    </x-ux::actions>

    <x-ux::list>
        @foreach($terms as $term)
            <x-ux::list-row>
                <x-ux::column margin="3">
                    <x-ux::link :label="$term->name.' Term'" click="$emit('showModal', 'terms.read', {{ $term->id }})"/>
                    <x-ux::item :data="$term->session" size="small" color="muted"/>
                </x-ux::column>
                <x-ux::column margin="3">
                    <x-ux::item :data="'starts: '.$term->start_date" />
                </x-ux::column>
                <x-ux::column margin="3">
                    <x-ux::item :data="'ends: '.$term->end_date" />
                </x-ux::column>

                <x-ux::action-column>
                    <x-ux::action icon="eye" :title="__('Read')" click="$emit('showModal', 'terms.read', {{ $term->id }})"/>
                    <x-ux::action icon="pencil-alt" :title="__('Update')" click="$emit('showModal', 'terms.save', {{ $term->id }})"/>
                    <x-ux::action icon="trash-alt" :title="__('Delete')" click="delete({{ $term->id }})" confirm/>
                </x-ux::action-column>
            </x-ux::list-row>
        @endforeach
    </x-ux::list>

    <x-ux::pagination :links="$terms"/>
</x-ux::layouts.page>
