<x-ux::layouts.modal :title="!$topic->exists ? __('Create Topic') : __('Update Topic')"  size="lg">
    <x-slot name="body">        
        
{{-- <div>
                <label class="form-label d-block" for="note">
                    Note
                </label>
            
                <div class="input-group"> 
                    <textarea name="note" class="summernote form-control rounded-end" rows="3" id="note" inputmode="text" id="note" wire:model.defer="model.note"></textarea>
 
                </div>        
            </div>   --}}


            {{-- <button id="edit" class="btn btn-primary" onclick="edit()" type="button">Edit 1</button>
<button id="save" class="btn btn-primary" onclick="save()" type="button">Save 2</button>
  <form method="post" id="form">
  <textarea  name="note" id="note" class="note" oninput="findTotal()"> </textarea>
</form> --}}

{{-- <textarea id="mytextarea" wire:model.defer="model.note"> --}}
  {{-- <p>To insert a 🙂 emoji, either:</p><ul><li>Type a colon followed by a keyword, e.g., <code>:smile</code>, then press <em>Enter</em> or&nbsp;<em>Return</em> to add the highlighted emoji, or click the desired emoji from those displayed, or</li><li>Select the emoticons toolbar button to open the picker, and use the tabs or search bar to browse, then click the desired emoji</li></ul><p>Try it here!&nbsp;</p> --}}
{{-- </textarea> --}}

{{-- <div class="col-md-12">
  <div class="form-group" wire:ignore>
      <label for="desciption">Note</label>
      <textarea type="text" name="summernoteInput" input="inf" class="form-control summernote">{{ $inf }}</textarea>
  </div>
</div>


        <textarea type="text" id="notes" wire:model="model.note" name="note"></textarea>  --}}
        {{-- <textarea id="note" wire:model.defer="model.note" name="note" class="summernote"></textarea>  --}}

        {{-- <form action="{{route('summernotePersist')}}" method="POST">  
          {{ csrf_field() }}
          <textarea name="summernoteInput" id="note" class="summernote"></textarea>
          <br>
          <button type="submit">Submit</button>
          </form> --}}
    

          <form action="{{route('summernotePersist')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{-- <input type="text" name="subje" id=""> --}}
        <x-ux::input :label="__('Subject')" model="subject_id" name="subject_id"/>
        <x-ux::input :label="__('Topic')" model="name" name="name"/>
        <x-ux::input :label="__('Class')" model="class_id" name="class_id"/>
        <x-ux::input :label="__('Term')" model="term" name="term"/>
            <textarea name="summernoteInput" id="note" wire:model.defer="model.note" class="summernote"></textarea>
            <br>
            {{-- <button type="submit">Submit</button> --}}
            
        <x-ux::button :label="__('Save')" type="submit" size="lg"/>
          </form>
          
    </x-slot>

    {{-- <x-slot name="footer">
        <x-ux::button :label="__('Cancel')" color="secondary" dismiss="modal"/>
        <x-ux::button :label="__('Save')" type="submit"/>      
    </x-slot> --}}

</x-ux::layouts.modal>



<script>
  

  $(document).ready(function() {
  $('#note').summernote({
        placeholder: '',
        tabsize: 2,
        height: 200
      });
});

</script>
