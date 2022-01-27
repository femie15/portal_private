<x-ux::layouts.modal :title="__('Lesson Note')" size="xl">
    <x-slot name="body">
        
        <center>
        @foreach ($getSub as $key => $name)
            @if ($topic->subject_id == $name )
                {{-- <x-ux::item icon="book" iconColor="primary" :data="$key"/> --}}
                <x-ux::desc :title="__('Subject')" :data="$key" icon="book" iconColor="primary"/>                      
            @endif
        @endforeach
            <x-ux::desc :title="__('Topic')" :data="$topic->name"/>
        @foreach ($getClass as $key => $name)
            @if ($topic->class_id == $name )
                {{-- <x-ux::item icon="graduation-cap" iconColor="primary" :data="$key"/>                       --}}
                <x-ux::desc :title="__('Class')" :data="$key" icon="graduation-cap" iconColor="primary"/>
            @endif
        @endforeach
        </center>


        <div style="overflow: scroll; width:100%;  height:100vh;">
            @php
                $readr=print_r(htmlspecialchars_decode($topic->note));
            @endphp         
                     <x-ux::column margin="3">
                             {{-- <x-ux::item :data="$readr" /> --}}
                             {{-- <x-ux::desc :title="__('')" :data="$readr"/> --}}
                     </x-ux::column> 
                 </div>

        
        {{-- <x-ux::desc :title="__('Created At')" :date="$topic->created_at"/>
        <x-ux::desc :title="__('Updated At')" :date="$topic->updated_at"/> --}}
    </x-slot>

    <x-slot name="footer">
        <x-ux::button :label="__('Close')" color="secondary" dismiss="modal"/>
    </x-slot>
</x-ux::layouts.modal>
