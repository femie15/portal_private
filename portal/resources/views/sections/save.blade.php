<x-ux::layouts.modal :title="!$section->exists ? __('Create Section') : __('Update Section')" submit="save">
    
    @php
    $pt = array(); 
     foreach ($getClass as $key => $name){    
         $pt[$name]=$key;
     }      
    @endphp 


    <x-slot name="body"> 
        <x-ux::select :label="__('Class')" :options="$pt" placeholder="Select Class" model="class_id" class="form-control" required/>  
        <x-ux::input :label="__('Name')" model="name"/>
        <x-ux::input :label="__('Nick Name')" model="nick_name"/>

        <x-ux::link :label="__('+Add New Class')" href="{{ url('/classeds') }}"/>
    </x-slot>


    <x-slot name="footer">
        <x-ux::button :label="__('Cancel')" color="secondary" dismiss="modal"/>
        <x-ux::button :label="__('Save')" type="submit"/>
    </x-slot>
</x-ux::layouts.modal>
