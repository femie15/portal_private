<x-ux::layouts.modal :title="!$user->exists ? __('New Parent Biodata') : __('Update Parent Biodata')" submit="save">
   @php           
$path_to_file ='assets/images/users/'.$user->id.'.jpg'; 
   @endphp

    <x-slot name="body">
        <div class="col-sm-8">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                
                <div>
                    <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" id="passport" wire:change="$emit('fileChosen')" accept="image/*">
                    </span>
                    <a href="#" class="btn btn-red fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div>

                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">

                    @if ($image)
                        @if (File::exists(public_path($image)))    
                            <img src="{{ $imager }}"  alt="Passport"  style="width: 100px; height: 100px;">
                        @else
                            @if ($image=='assets/images/users/'.$user->id.'.jpg')
                            <x-ux::image src="../assets/images/users/user.jpg" width="100px" height="100px" circle/>
                            @else
                            <x-ux::image src="{{ $imager }}" width="100px" height="100px" circle/>
                            @endif
                         @endif
                     @else
                        <img src="http://placehold.it/200x200" alt="..."  style="width: 100px; height: 100px;">
                    @endif
                    
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>

                {{-- <div class="progress">
                    <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                      <span class="sr-only">40% Complete (success)</span>
                    </div>
                  </div> --}}

            </div>
        </div>


        <x-ux::input :label="__('Name')" model="name" required/>
     @if(!$user->exists)
     <x-ux::input :label="__('Email')" type="email" model="email"/>
     @else
     <x-ux::input :label="__('Email')" type="email" model="email"/>
     
     <x-ux::input :label="__('Login Code')" type="number" model="code" disabled/>
     @endif     
        {{-- <x-ux::input :label="__('Admission Number')" model="roll"/> --}}
        <x-ux::input :label="__('Date of Birth')" type="date" model="birthday" class="datepicker"/>
        <x-ux::select :label="__('Gender')" :options="['male'=>'Male', 'female'=>'Female']" model="sex" class="form-control" required/>
        <x-ux::input :label="__('Address')" model="address"/>
        <x-ux::input :label="__('Phone Number')" model="phone"/>
        <x-ux::select :label="__('Religion')" :options="['Christianity', 'Islam', 'Others']" model="religion" class="form-control"/>
        {{-- <x-ux::input :label="__('Class')" type="number" model="class_id" required/>
        
        <x-ux::input :label="__('Section')" type="number" model="section_id" required/>
        <x-ux::input :label="__('Parent')" type="number" model="parent_id"/> --}}
        {{-- <x-ux::input :label="__('Image')" type="file" model="house"/> --}}
        <x-ux::select :label="__('State of origin')" class="form-control" :options="[
            'Abia',
            'Adamawa',
            'Akwa Ibom',
            'Anambra',
            'Bauchi',
            'Bayelsa',
            'Benue',
            'Borno',
            'Cross River',
            'Delta',
            'Ebonyi',
            'Edo',
            'Ekiti',
            'Enugu',
            'FCT - Abuja',
            'Gombe',
            'Imo',
            'Jigawa',
            'Kaduna',
            'Kano',
            'Katsina',
            'Kebbi',
            'Kogi',
            'Kwara',
            'Lagos',
            'Nasarawa',
            'Niger',
            'Ogun',
            'Ondo',
            'Osun',
            'Oyo',
            'Plateau',
            'Rivers',
            'Sokoto',
            'Taraba',
            'Yobe',
            'Zamfara'
          ]" model="state"/>

        @if(!$user->exists)
            <x-ux::input :label="__('Password')" type="password" model="password" required/>
            <x-ux::input :label="__('Confirm Password')" type="password" model="password_confirmation" required/>
        @endif
    </x-slot>
 
    <x-slot name="footer">
        <x-ux::button :label="__('Cancel')" color="secondary" dismiss="modal"/>
        <x-ux::button :label="__('Save')" type="submit"/>
    </x-slot>
</x-ux::layouts.modal>

<script>
    window.Livewire.on('fileChosen', () => {
        let myPass = document.getElementById('passport');
        let file = myPass.files[0];
        let reader = new FileReader();
        reader.onloadend = ()=>{
            window.Livewire.emit('fileUpload',reader.result);
            // console.log(reader.result);
        }
        reader.readAsDataURL(file);
    })
    </script>
