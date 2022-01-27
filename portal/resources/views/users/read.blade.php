<x-ux::layouts.modal :title="__('Student Biodata')">
    <x-slot name="body">
        {{-- <x-ux::desc :title="__('ID')" :data="$user->id"/> --}}
        <x-ux::desc :title="__('Name')" :data="$user->name"/>
            <x-ux::desc :title="__('Login Code')" :data="$user->code"/>
        <x-ux::desc :title="__('Admission Number')" :data="$user->roll"/>
        <x-ux::desc :title="__('Date of Birth')" :data="$user->birthday"/>
        <x-ux::desc :title="__('Gender')" :data="$user->sex"/>
        <x-ux::desc :title="__('Address')" :data="$user->address"/>
        <x-ux::desc :title="__('Phone Number')" :data="$user->phone"/>
        <x-ux::desc :title="__('Religion')" :data="$user->religion"/>
            
        @foreach ($getClass as $key => $name) 
            @if ($user->class_id == $name)
                <x-ux::desc :title="__('Class')" :data="$key"/>
            @endif
        @endforeach
        @foreach ($getSection as $key => $name)
            @if ($user->section_id == $name->id)
                <x-ux::desc :title="__('Section')" :data="$name->name.'('.$name->nick_name.')'"/>
            @endif
        @endforeach
        {{-- {{ dd($user->state) }} --}}
        <x-ux::desc :title="__('Parent')" :data="'\App\Components\Users\Read'::getParent($user->parent_id)"/>
        <x-ux::desc :title="__('State of origin')" :data="$user->state"/>
        
        @if ($user->debt==0)
        <x-ux::desc :title="__('Owing School')" :data="'Not Owing'"/>
        @else        
        <x-ux::desc :title="__('Owing School')" :data="'Yes, The student is Owing'"/>            
        @endif

        {{-- <x-ux::desc :title="__('Created At')" :date="$user->created_at"/>
        <x-ux::desc :title="__('Updated At')" :date="$user->updated_at"/> --}}
    </x-slot>

    <x-slot name="footer">
        <x-ux::button :label="__('Close')" color="secondary" dismiss="modal"/>
    </x-slot>
</x-ux::layouts.modal>
