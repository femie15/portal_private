<x-ux::layouts.page :title="__('Schools')">
    <x-ux::actions search>
        <x-ux::button icon="plus" :title="__('Create')" click="$emit('showModal', 'schools.save')"/>
        <x-ux::action-dropdown key="sort"/>
        <x-ux::action-dropdown key="filter"/>
    </x-ux::actions>

    <x-ux::list>
        @foreach($schools as $school)
            <x-ux::list-row>
                <x-ux::column margin="3"  style="color: {{ $school->colour }};">
                
        @if ('\App\Components\Users\Read'::getUser($school->school_id)['other']=='')
            <x-ux::link :label="strtoupper(__('N/A'))" click="$emit('showModal', 'schools.read', {{ $school->id }})" />
        @else
            <x-ux::link :label="strtoupper('\App\Components\Users\Read'::getUser($school->school_id)['other']->name)" click="$emit('showModal', 'schools.read', {{ $school->id }})" />
        @endif
                    <x-ux::item :date="$school->created_at" size="small" color="muted"/>
                </x-ux::column>

                
                <x-ux::column margin="3">
                    {{-- <x-ux::item :data="$school->school_id" color="muted"/> --}}
                    <x-ux::item :data="$school->web" color="muted"/>
                </x-ux::column>
                <x-ux::column margin="3">
                    {{-- <x-ux::item :data="$school->school_id" color="muted"/> --}}
                    @if ('\App\Components\Users\Read'::getUser($school->school_id)['other']=='')
                    <x-ux::item :data="__('N/A')" color="muted"/>
                    @else
                    <x-ux::item :data="'\App\Components\Users\Read'::getUser($school->school_id)['other']->email" color="muted"/>
                    @endif

                        <div style="background-color: {{ $school->colour }}; color:#e0e0e0;">School Colour: {{ $school->colour }}</div>
                </x-ux::column>

                <x-ux::action-column>
                    <x-ux::action icon="eye" :title="__('Read')" click="$emit('showModal', 'schools.read', {{ $school->id }})"/>
                    {{-- <x-ux::action icon="pencil-alt" :title="__('Update')" click="$emit('showModal', 'schools.save', {{ $school->id }})"/>
                    <x-ux::action icon="trash-alt" :title="__('Delete')" click="delete({{ $school->id }})" confirm/> --}}
                </x-ux::action-column>
            </x-ux::list-row>
        @endforeach
    </x-ux::list>

    <x-ux::pagination :links="$schools"/>
</x-ux::layouts.page>
