<x-ux::layouts.page :title="__('eLibrary')">
    <br>
    
{{-- panel head --}}
<div class="col-md-12"> <div class="panel minimal minimal-gray">   
        <div class="panel-heading"> 
      <div class="panel-title"></div> 
      
      <div class="panel-options"> 
        <center>
        <ul class="nav nav-tabs"> 
        <li class="active">
          <a href="#profile-1" data-toggle="tab" aria-expanded="true" class="btn btn-primary">eBooks</a>
        </li> 
        <li class=""> 
          &emsp;&emsp;
          <a href="#profile-2" data-toggle="tab" aria-expanded="false" class="btn btn-primary">Past Questions</a>
        </li> </ul> 
      </center> 
      </div> 
    </div> 

    <div class="panel-body"> <div class="tab-content"> 
        {{-- 1 --}}
        <div class="tab-pane active" id="profile-1"> 
            <center><h2>eBooks</h2></center> 
              <x-ux::actions search>
                  {{-- <x-ux::button icon="plus" :title="__('Create')" click="$emit('showModal', 'elibraries.save')"/> --}}
              </x-ux::actions>          
          <br>   
          <div class="row"> 
              @foreach($elibraries as $elibrary)
                    <div class="col-md-3">       
                        <a href="{{ url('library/ebook/books/'.$elibrary->name.'.pdf') }}" target="_blank">
                            <x-ux::image src="{{ url('library/ebook/images/'.$elibrary->name.'.jpg') }}" fluid thumbnail/>   
                        </a>                 
                    </div>
              @endforeach    
         </div>            
            <x-ux::pagination :links="$elibraries"/>
          </div> 
    
     
      {{-- 2 --}}
    <div class="tab-pane" id="profile-2"> 
      <center><h2>Past Questions</h2></center> 
        <x-ux::actions search>
            {{-- <x-ux::button icon="plus" :title="__('Create')" click="$emit('showModal', 'elibraries.save')"/> --}}
        </x-ux::actions>    
    <br>   
    <div class="row"> 
        @foreach($elibrariespq as $elibrarypq)
              <div class="col-md-3">      
                <a href="{{ url('library/pastquestion/'.$elibrarypq->name.'.pdf') }}" target="_blank">
                    <x-ux::image src="{{ url('library/ebook/images/'.$elibrarypq->name.'.jpg') }}" fluid thumbnail/>   
                </a>           
              </div>
        @endforeach          
    </div>         
      <x-ux::pagination :links="$elibrariespq"/>
    </div> 
    
    </div> </div> </div> </div>

    {{-- <x-ux::pagination :links="$elibraries"/> --}}

</x-ux::layouts.page>
