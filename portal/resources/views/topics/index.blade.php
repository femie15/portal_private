<x-ux::layouts.page :title="__('Lesson Notes')">
    <x-ux::actions search>
        {{-- <x-ux::button icon="plus" :title="__('Create')" click="$emit('showModal', 'topics.save')"/> --}}
        <x-ux::link icon="plus-square fa-3x" href="{{url('/classa') }}/0"/>
        <x-ux::action-dropdown key="sort"/>
        {{-- <x-ux::action-dropdown key="filter"/> --}}
    </x-ux::actions>

    <x-ux::list>
        @foreach($topics as $topic)
            <x-ux::list-row>
                <x-ux::column margin="3">
                    <x-ux::link :label="$topic->name" click="$emit('showModal', 'topics.read', {{ $topic->id }})"/>
                </x-ux::column>
            
                <x-ux::column margin="3">
                {{-- <x-ux::item :data="$topic->subject_id" />                     --}}
                        @foreach ($getSub as $key => $name)
                            @if ($topic->subject_id == $name )
                                <x-ux::item :data="$key"/>                      
                            @endif
                        @endforeach
                </x-ux::column>
@php
    if($topic->term=='1'){$den="1st Term";}
    elseif($topic->term=='2'){$den="2nd Term";}
    elseif($topic->term=='3'){$den="3rd Term";}
    else{$den="";}
@endphp
                <x-ux::column margin="3">                   
                @foreach ($getClass as $key => $name)
                    @if ($topic->class_id == $name )
                        <x-ux::item icon="graduation-cap" iconColor="primary" :data="$key"/> {{ $den }}     
                    @endif
                @endforeach
                </x-ux::column>
                
                {{-- <div style="overflow: scroll; width:500px;  height:200px;">
       @php
           $readr=print_r(htmlspecialchars_decode($topic->note));
       @endphp         
                <x-ux::column margin="3">
                        <x-ux::item :data="$readr" />
                </x-ux::column> 
            </div> --}}

                <x-ux::action-column>
                    {{-- <x-ux::action label="Lesson Diary" icon="book" :title="__('Diary')" click="$emit('showModal', 'topics.readr', {{ $topic->id }})"/> --}}
                    <x-ux::action label="Lesson Diary" icon="book" :title="__('Diary')" click="$emit('showModal', 'diaries.read', {{ '\App\Components\Topics\Index'::diary($topic->id); }})"/>

                    <x-ux::action icon="eye" :title="__('Read')" click="$emit('showModal', 'topics.read', {{ $topic->id }})"/>

                    <x-ux::link icon="pencil-alt fa-2x" href="{{url('/classa') }}/{{ $topic->id }}"/>
                        {{-- <x-ux::action icon="pencil-alt" :title="__('Update')" click="$emit('showModal', 'topics.save', {{ $topic->id }})"/> --}}
                    {{-- <x-ux::action icon="trash-alt" :title="__('Delete')" click="delete({{ $topic->id }})" confirm/> --}}
                </x-ux::action-column>
            </x-ux::list-row>
        @endforeach
    </x-ux::list>

    <x-ux::pagination :links="$topics"/>
</x-ux::layouts.page>
