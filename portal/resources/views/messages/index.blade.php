<x-ux::layouts.page :title="__('Messages')">
    <x-ux::actions search>
         {{-- <x-ux::button icon="plus" :title="__('Create')" click="$emit('showModal', 'messages.save')"/> --}}
       {{-- <x-ux::action-dropdown key="sort"/>
        <x-ux::action-dropdown key="filter"/> --}}
    </x-ux::actions>
<br><br>
    <center> 
        @if ($select)
        <x-ux::action-dropdown key="filter" icon="users" label="{{ $select }}"/>
        @else
        <x-ux::action-dropdown key="filter" icon="users" label="Select Participant"/>
        @endif
        {{-- <x-ux::button icon="users" :title="__('Parents')" label="Message a Parent" href="{{ url('/parent') }}"/>
        <x-ux::button icon="user" :title="__('Teachers')" label="Message a Teacher" href="{{ url('/teacher') }}"/>
        <x-ux::button icon="group" :title="__('Students')" label="Message a Student" href="{{ url('/student') }}"/> --}}
    </center>


    <x-ux::list>
        @foreach($messages as $message)
            <x-ux::list-row>
                <x-ux::column margin="3">
                    <x-ux::item :data="$message->name" click="$emit('showModal', 'messages.read', {{ $message->id }})"/>
                    <x-ux::item :date="$message->created_at" size="small" color="muted"/>
                </x-ux::column>

                <x-ux::action-column>
                    {{-- <x-ux::action icon="eye" :title="__('Read')" click="$emit('showModal', 'messages.read', {{ $message->id }})"/> --}}
                    <x-ux::link icon="envelope-open-text fa-3x" :title="__('Send Message')" click="$emit('showModal', 'messages.save',{{ $message->id }})"/>
                </x-ux::action-column>
            </x-ux::list-row>
        @endforeach
    </x-ux::list>

    <x-ux::pagination :links="$messages"/>
</x-ux::layouts.page>
