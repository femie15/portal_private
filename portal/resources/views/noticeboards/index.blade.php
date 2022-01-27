<x-ux::layouts.page :title="__('Noticeboard')">
    <x-ux::actions search>
        @if (Auth::user()->role !="student" && Auth::user()->role !="parent")
        <x-ux::button icon="plus" :title="__('Create')" click="$emit('showModal', 'noticeboards.save')"/>
        @endif
        <x-ux::action-dropdown key="sort"/>
        <x-ux::action-dropdown key="filter"/>
    </x-ux::actions>

@php
    $sn=1;
@endphp
    <x-ux::list>
        @foreach($noticeboards as $noticeboard)
            <x-ux::list-row>
                {{-- <x-ux::column margin="1">
                    {{ $sn++ }}
                </x-ux::column> --}}
                <x-ux::column margin="2">
                    <x-ux::link :label="$noticeboard->notice_title" click="$emit('showModal', 'noticeboards.read', {{ $noticeboard->id }})"/>
                </x-ux::column>
                <x-ux::column margin="5">
                    <x-ux::link :label="$noticeboard->notice" click="$emit('showModal', 'noticeboards.read', {{ $noticeboard->id }})"  color="primary"/>
                </x-ux::column>
                <x-ux::column margin="1">                    
                    <x-ux::item :data="date('d M,Y',$noticeboard->created_timestamp)" size="large" color="muted"/>
                </x-ux::column>

                <x-ux::action-column>
                    <x-ux::action icon="eye" :title="__('Read')" click="$emit('showModal', 'noticeboards.read', {{ $noticeboard->id }})"/>
                    
				@if (Auth::user()->role !="student" && Auth::user()->role !="parent")
                    <x-ux::action icon="pencil-alt" :title="__('Update')" click="$emit('showModal', 'noticeboards.save', {{ $noticeboard->id }})"/>
                    <x-ux::action icon="trash-alt" :title="__('Delete')" click="delete({{ $noticeboard->id }})" confirm/>
                @endif
                </x-ux::action-column>
            </x-ux::list-row>
        @endforeach
    </x-ux::list>

    <x-ux::pagination :links="$noticeboards"/>
</x-ux::layouts.page>
