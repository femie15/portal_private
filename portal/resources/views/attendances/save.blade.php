<x-ux::layouts.modal :title="!$attendance->exists ? __('Create Attendance') : __('Update Attendance')" submit="save">
    @php
         $parnt=[];
     if($attendances){ 
        foreach ($attendances as $attendance){   
            //  dd($attendance); 
            $parnt[$attendance->id]=$attendance->name;
        }      
    }else {
        $parnt=null;
    }

    // dd($parnt);
    @endphp
    
    <x-slot name="body">
        {{-- <x-ux::input :label="__('Name')" model="name"/> --}}
        <x-ux::select :label="__('Name')" :options="$parnt" model="name" class="form-control"/>
    </x-slot>
 
    <x-slot name="footer">
        <x-ux::button :label="__('Cancel')" color="secondary" dismiss="modal"/>
        <x-ux::button :label="__('Save')" type="submit"/>
    </x-slot>
</x-ux::layouts.modal>
