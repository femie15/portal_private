<x-ux::layouts.page :title="__('Sections')">
    <x-ux::actions search>
        <x-ux::button icon="plus" :title="__('Create')" click="$emit('showModal', 'sections.save')"/>
        <x-ux::action-dropdown key="sort"/>
        {{-- <x-ux::action-dropdown key="filter"/> --}}
    </x-ux::actions>

    <x-ux::list>
        @foreach($sections as $section)
            <x-ux::list-row>
                <x-ux::column margin="3">
                    <x-ux::link :label="$section->name" click="$emit('showModal', 'sections.read', {{ $section->id }})"/>
                    {{-- <x-ux::item :date="$section->created_at" size="small" color="muted"/> --}}
                </x-ux::column>
                
                <x-ux::column margin="3">
                    <x-ux::link :label="$section->nick_name" click="$emit('showModal', 'sections.read', {{ $section->id }})"/>
                </x-ux::column>
                <x-ux::column margin="3">
                    {{-- {{ $getClass }} --}}
                @foreach ($getClass as $key => $name)
                    @if ($section->class_id == $name )
                        <x-ux::item icon="graduation-cap" iconColor="primary" :data="$key"/>                      
                    @endif
                @endforeach
                    {{-- <x-ux::link :label="$section->class_id" click="$emit('showModal', 'sections.read', {{ $section->id }})"/> --}}
                </x-ux::column>

                <x-ux::action-column>
                    <x-ux::action icon="eye" :title="__('Read')" click="$emit('showModal', 'sections.read', {{ $section->id }})"/>
                    <x-ux::action icon="pencil-alt" :title="__('Update')" click="$emit('showModal', 'sections.save', {{ $section->id }})"/>
                    <x-ux::action icon="trash-alt" :title="__('Delete')" click="delete({{ $section->id }})" confirm/>
                </x-ux::action-column>
            </x-ux::list-row>
        @endforeach
    </x-ux::list>

    <x-ux::pagination :links="$sections"/>
</x-ux::layouts.page>
