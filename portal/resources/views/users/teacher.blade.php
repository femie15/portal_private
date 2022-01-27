<x-ux::layouts.page :title="__('Teachers')">
    <x-ux::actions search>
        <x-ux::button icon="plus" :title="__('Add New Teacher')" click="$emit('showModal', 'users.saveteacher')" label="Add New Teacher"/>
        <x-ux::action-dropdown key="sort"/>
        {{-- <x-ux::action-dropdown key="filter"/> --}}
    </x-ux::actions>

    <x-ux::list>
        @foreach($users as $user)
            <x-ux::list-row>
                <x-ux::column margin="3">
                    @php           
                    $path_to_file ='assets/images/users/'.$user->id.'.jpg';     
                    @endphp 
                        @if (File::exists(public_path($path_to_file)))
                            <x-ux::image asset="{{ $path_to_file }}" width="60px" height="60px" circle/>
                        @else
                            <x-ux::image src="../assets/images/users/user.jpg" width="60px" height="60px" circle/>
                        @endif
                        
                    <x-ux::link :label="$user->name" click="$emit('showModal', 'users.readteacher', {{ $user->id }})"/>
                </x-ux::column>
                <x-ux::column margin="2">
                    <x-ux::item icon="phone" iconColor="success" :data="$user->phone"/>
                </x-ux::column>
                <x-ux::column margin="3">
                    <x-ux::item :data="$user->email"/>
                </x-ux::column>

                <x-ux::action-column>
                    <x-ux::action icon="eye" :title="__('Read')" click="$emit('showModal', 'users.readteacher', {{ $user->id }})"/>
                    <x-ux::action icon="pencil-alt" :title="__('Update')" click="$emit('showModal', 'users.saveteacher', {{ $user->id }})"/>
                    <x-ux::action icon="unlock-alt" :title="__('Password')" click="$emit('showModal', 'users.password', {{ $user->id }})"/>
                    <x-ux::action icon="trash-alt" :title="__('Delete')" click="delete({{ $user->id }})" confirm/>
                </x-ux::action-column>
            </x-ux::list-row>
        @endforeach
    </x-ux::list>

    <x-ux::pagination :links="$users"/>
</x-ux::layouts.page>


{{-- <script>
    // Material Select Initialization
$(document).ready(function() {
$('.mdb-select').materialSelect();
});
</script> --}}