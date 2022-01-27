<x-ux::layouts.page :title="__('Student')">
    <x-ux::actions search>
        <x-ux::button icon="plus" :title="__('Add New Student')" label="Add New Student" click="$emit('showModal', 'users.save')" />
        {{-- <x-ux::action-dropdown key="filter"/> --}}
        {{-- <x-ux::action-dropdown key="sort"/> --}}
    </x-ux::actions>
    
    <x-ux::link icon="graduation-cap" : title="All sections" label="All Sections" class="btn btn-primary btn-sm" href="?luppy=all"/>
@php
    $cid='';
@endphp
            @forelse($getSection as $resulta)
                @forelse ($getClass as $key => $name)
                    @if ($resulta->class_id == $name)
                        <x-ux::link icon="graduation-cap" :title="$resulta->name" label="{{ $key }}{{ $resulta->name }} ({{ $resulta->nick_name }})" class="btn btn-primary btn-sm" href="?luppy={{ $resulta->id }}"/>
                        @php
                            $cid=$name;
                        @endphp
                    @endif
                @empty
                        <p>kindly add classes</p>
                @endforelse
            @empty
                <p>kindly add class sections</p>
            
            @endforelse
 <br>
 
  
      @if (isset($_GET['luppy']) && is_numeric($_GET['luppy']))
        @php
            $lup=$_GET['luppy'];
        @endphp
        
            <center>
                <a href="{{ url('/bulk') }}/{{ $cid }}?name={{ $lup }}"> <b> Bulk Termly Result</b></a> | 
                <a href="{{ url('/midtermbulk') }}/{{ $cid }}?name={{ $lup }}"><b>Bulk Midterm Result</b></a>
            </center> 
       @else
            <center>
                <a href="{{ url('/bulk') }}/{{ $cid }}"> <b> Bulk Termly Result</b></a> | 
                <a href="{{ url('/midtermbulk') }}/{{ $cid }}"><b>Bulk Midterm Result</b></a>
            </center> 
        @endif 
 
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
                    <x-ux::link :label="$user->name" click="$emit('showModal', 'users.read', {{ $user->id }})"/>
                    {{-- <x-ux::item :date="$user->roll" label="Admission Number:" size="small" color="muted"/> &emsp; --}}
                    <x-ux::item icon="tag" iconColor="success" :data="$user->roll"/>
                    <x-ux::item icon="{{ $user->sex }}" iconColor="success" :data="$user->sex"/>
                </x-ux::column>

                <x-ux::column margin="3">
                <x-ux::item icon="lock" iconColor="success" :data="$user->code"/>
                </x-ux::column>

                <x-ux::column margin="3">
                    <x-ux::item icon="at" iconColor="success" :data="$user->email"/>
                </x-ux::column>

                <x-ux::column margin="2">
                @foreach ($getClass as $key => $name)
                    @if ($user->class_id == $name)
                        <x-ux::item icon="graduation-cap" iconColor="primary" :data="$key"/>                      
                    @endif
                @endforeach
                @foreach ($getSection as $key => $name)
                    @if ($user->section_id == $name->id)
                        {{ $name->name}}({{ $name->nick_name}})
                    @endif
                @endforeach
                </x-ux::column>

                <x-ux::action-column>
                    <x-ux::action icon="eye" :title="__('Read')" click="$emit('showModal', 'users.read', {{ $user->id }})"/>
                    <x-ux::action icon="pencil-alt" :title="__('Update')" click="$emit('showModal', 'users.save', {{ $user->id }})"/>
                        
                    <x-ux::action icon="book-open" :title="__('Marksheet')" href="{{ url('/mark') }}/{{ $user->id }}"/>

                    <x-ux::action icon="unlock-alt" :title="__('Password')" click="$emit('showModal', 'users.password', {{ $user->id }})"/>
                    <x-ux::action icon="trash-alt" :title="__('Delete')" click="delete({{ $user->id }})" confirm/>
                </x-ux::action-column>
            </x-ux::list-row>
        @endforeach
    </x-ux::list>

    <x-ux::pagination :links="$users"/>
</x-ux::layouts.page>
