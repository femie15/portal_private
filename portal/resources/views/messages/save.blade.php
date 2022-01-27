<x-ux::layouts.modal :title="!$talks ? __('Start a Conversation') : __('Conversations')" submit="save" size="lg" name="ket">

<x-slot name="body">

<div wire:poll.750ms>

<center style="color: rgb(112, 112, 243);">
    Current time: {{ now() }} 
    <hr>
    @if ($errors)
                                @error('message')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            @endif
</center>
    

    <!-- Direct Chat -->
    <div class="row justify-content-center" >

     
        <br>

        <div class="col-md-12">
            <!-- DIRECT CHAT DANGER -->
            <div class="card">
                <div class="card card-danger direct-chat direct-chat-danger">
                <!-- /.card-header -->
            <div class="card">
                <div class="card-body">
 @if (count($talks)>0)
                    <div class="direct-chat-messages" id="chata" style="height: 70vh;">

                        <!-- Sender meassage --> 
                        @foreach($talks as $messa)
                        @if($messa->sender == Auth::user()->id)
<br>
                                <div class="direct-chat-msg right" >
                                    <span style="float:right">
                                    <div class="direct-chat-infos clearfix" >
                                        <span class="direct-chat-name float-right" style="float:right">.</span>
                                        <span class="direct-chat-timestamp float-right" style="float:right">
                                            {{ \Carbon\Carbon::parse($messa->created_at)->diffForHumans()}}
                                        </span>
                                    </div>
                                    
                                    <!-- /.direct-chat-infos -->
                                    
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text" style="background-color:rgb(233, 243, 233); float:right; width:80%;">
                                        {{$messa->message}}
                                        <br>
                                        <small style="color:rgba(51, 51, 122, 0.37);">{{ \Carbon\Carbon::parse($messa->created_at)->timezone(Auth::user()->timezone)->toDayDateTimeString() }}</small>
                                    </div>
                                </span>
                                    <!-- /.direct-chat-text -->
                                </div>


                            @else
<br>
                                <div class="direct-chat-msg">
                                    <span style="float:left;">
                                    <div class="direct-chat-infos clearfix" >
                                        <span class="direct-chat-name float-left">{{ $mename }}</span>
                                        <span class="direct-chat-timestamp float-right"> 
                                            ({{ \Carbon\Carbon::parse($messa->created_at)->diffForHumans()}})
                                        </span>
                                    </div>
                                    <!-- /.direct-chat-infos -->
                                    <img class="direct-chat-img" src="{{asset('assets/images/users/user.jpg')}}" alt="Message User Image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text" style="background-color:rgb(240, 218, 218); width:80%;">
                                        {{$messa->message}}
                                        <br>
                                        <small style="color:rgba(51, 51, 122, 0.37);">{{ \Carbon\Carbon::parse($messa->created_at)->timezone(Auth::user()->timezone)->toDayDateTimeString() }}</small>
                                    </div>
                                </span>
                                    <!-- /.direct-chat-text -->
                                </div>

                            @endif
                          @endforeach

                        </div>

                        @else
                                    <h5 style="text-align: center;color:red"> Say Hello !</h5>
                        @endif


    
                </div>
                <!-- /.card-body -->
                <div class="type_msg" > 
                        <div class="input-group"> 
                            <br>
                                <input type="text" inputmode="text" id="message" name="message"  wire:model.defer="model.message" class="form-control rounded-end write_msg" onkeydown="scrollDown()" data-emojiable="true" data-emoji-input="unicode">                             
                            
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-success" onmouseup="clr()"> <i class="fas fa-paper-plane"></i> Send</button>  
                            </span> 
                        </div> 
                </div>


                <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>








{{-- emoji --}}
  <!-- Begin emoji-picker JavaScript -->
  <script src="{{asset('assets/emoji/js/config.js')}}"></script>
  <script src="{{asset('assets/emoji/js/util.js')}}"></script>
  <script src="{{asset('assets/emoji/js/jquery.emojiarea.js')}}"></script>
  <script src="{{asset('assets/emoji/js/emoji-picker.js')}}"></script>
  <!-- End emoji-picker JavaScript -->

  <script>
//     $(function() {
//       // Initializes and creates emoji set from sprite sheet
//       window.emojiPicker = new EmojiPicker({
//         emojiable_selector: '[data-emojiable=true]',
//         assetsPath: '{{asset("assets/emoji/img/")}}',
//         popupButtonClasses: 'fa fa-smile-o'
//       });
//       window.emojiPicker.discover();
//     });

</script>



</x-slot>

{{-- <x-slot name="footer">

    <x-ux::button :label="__('Cancel')" color="danger" dismiss="modal"/>
    <x-ux::button :label="__('Save')" type="submit"/>
</x-slot> --}}
</x-ux::layouts.modal>


<script>

     function clr() {    
    document.getElementById("message").value="";   
	var form = document.getElementByName("ket");
form.reset(); 
    }

</script>