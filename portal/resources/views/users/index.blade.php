<x-ux::layouts.page :title="__('Users')">
    <x-ux::actions search>
        <x-ux::button icon="plus" :title="__('Create')" click="$emit('showModal', 'users.save')"/>
        <x-ux::action-dropdown key="sort"/>
        <x-ux::action-dropdown key="filter"/>
    </x-ux::actions>

    <x-ux::list>
        @foreach($users as $user)
            <x-ux::list-row>
                <x-ux::column margin="3">
            
        @php 
        // http://127.0.0.1:8000/assets/images/users/user.jpg   
            // $path_to_file ="http://127.0.0.1:8000/assets/images/users/1.jpg";           
            $path_to_file ="../assets/images/users/".$user->id.".jpg";           
        @endphp
{{-- come back later --}}
            @if (file_exists($path_to_file))
                <img src="{{ $path_to_file }}" alt="picture" width="40px">
            @else
                <img src="../assets/images/users/user.jpg" alt="picture" width="40px">
            @endif
        {{-- <img src="../assets/images/users/{{ $user->id }}.jpg" alt="picture" width="40px"> --}}
                    <x-ux::link :label="$user->name" click="$emit('showModal', 'users.read', {{ $user->id }})"/>
                    <x-ux::item :date="$user->created_at" size="small" color="muted"/>
                </x-ux::column>

                <x-ux::action-column>
                    <x-ux::action icon="eye" :title="__('Read')" click="$emit('showModal', 'users.read', {{ $user->id }})"/>
                    <x-ux::action icon="pencil-alt" :title="__('Update')" click="$emit('showModal', 'users.save', {{ $user->id }})"/>
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