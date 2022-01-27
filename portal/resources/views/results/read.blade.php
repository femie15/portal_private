<x-ux::layouts.modal :title="__('Position')">
   @php   
   $sect= array();  
   $c='<option value="Class"> select Class</option>';
   $ts='<option value="ts">Term / Session</option>';
        if($ss && count($ss)>0){  
            foreach ($ss as $key => $name){    
                $sect[$name]=$name;
                $ts.='<option value="'.$name.'">'.$name.'</option>';
            }      
        }
// dd($cls);
        if($cls && count($cls)>0){  
            foreach ($cls as $key => $name){    
                // $clas[$key]=$name;
                $c.='<option value="'.$key.'">'.$name.'</option>';
            }      
        }
   @endphp



<x-slot name="body">  
        <form action="{{ url('/position') }}" method="POST">
            @csrf
            {{-- <x-ux::select :label="__('Class')" :options="$clas" placeholder="Class" class="form-control" name="cl" />  --}}
            <select name="cls"  class="form-control">
               @php
                  echo $c;
               @endphp
            </select> <br>
            
            <select name="ts"  class="form-control">
                
                @php
                  echo  $ts;
                @endphp
             </select>
            {{-- <x-ux::select :label="__('Term / Session')" :options="$sect" placeholder="Term / Session" class="form-control" name="trm" />  --}}
             <br>
        <x-ux::button :label="__('Set positions')" type="submit"/>
    </form>
    </x-slot>

    <x-slot name="footer">
        <x-ux::button :label="__('Close')" color="secondary" dismiss="modal"/>
    </x-slot>
</x-ux::layouts.modal>
