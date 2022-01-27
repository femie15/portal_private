<x-ux::layouts.page :title="__('Student ID Card')">
    {{-- <x-ux::actions search>
    </x-ux::actions> --}}
 
    <style>
        body {
                background-color: #fff;
                font-family:'verdana';
            }
            .id-card-holder {
                width: 255px;
                padding: 2px;
                /* margin: 0 auto; */
                background-color: rgb(184, 184, 184);
                border-radius: 15px;
                /* border: 1px;
                border-color: #000; */
                position: relative;
                /* float:left; */
            }
            /* .id-card-holder:after {
                content: '';
                display: block;
                background-color: #0a0a0a;
                height: 100px;
                position: absolute;
                top: 105px;
                border-radius: 0 5px 5px 0;
            }
            .id-card-holder:before {
                content: '';
                display: block;
                background-color: #0a0a0a;
                height: 100px;
                position: absolute;
                top: 105px;
                left: 222px;
                border-radius: 5px 0 0 5px;
            } */
            .id-card {
                
                background-color: #ffffff;
                padding: 3px;
                border-radius: 10px;
                text-align: center;
                box-shadow: 2px 2px 1.5px 3px #b9b9b9;
            }
            .id-card img {
                margin: 0 auto;
            }
            .header img {
                width: 100px;
                margin-top: 5px;
            }
            .photo img {
                width: 127px;
                margin-top: 10px;
            }
            h2 {
                font-size: 15px;
                margin: 1px 0;
            }
            h3 {
                font-size: 12px;
                font-weight: 300;
            }
            
            h6 {
                font-size: 11px;
                font-weight: 300;
            }
            .qr-code img {
                width: 130px;
                margin-top: -17px;
            }
            
            .qr-codeback img{
                width: 190px;
                margin-top: -17px;
            }
            .qr-codeback .output{
                width: 170px;
                /* margin-top: -17px; */
            }
            p {
                font-size: 7px;
                margin: 0px;
            }
            .id-card-hook {
                background-color: #000;
                width: 70px;
                margin: 0 auto;
                height: 15px;
                border-radius: 5px 5px 0 0;
            }
            .id-card-hook:after {
                content: '';
                background-color: #d7d6d3;
                width: 47px;
                height: 6px;
                display: block;
                margin: 0px auto;
                position: relative;
                top: 6px;
                border-radius: 4px;
            }
            .id-card-tag-strip {
                width: 45px;
                height: 40px;
                background-color: #0950ef;
                margin: 0 auto;
                border-radius: 5px;
                position: relative;
                top: 9px;
                z-index: 1;
                border: 1px solid #0041ad;
            }
            .id-card-tag-strip:after {
                content: '';
                display: block;
                width: 100%;
                height: 1px;
                background-color: #c1c1c1;
                position: relative;
                top: 10px;
            }
            .id-card-tag {
                width: 0;
                height: 0;
                border-left: 100px solid transparent;
                border-right: 100px solid transparent;
                border-top: 100px solid #0958db;
                margin: -10px auto -30px auto;
            }
            .id-card-tag:after {
                content: '';
                display: block;
                width: 0;
                height: 0;
                border-left: 50px solid transparent;
                border-right: 50px solid transparent;
                border-top: 100px solid #d7d6d3;
                margin: -10px auto -30px auto;
                position: relative;
                top: -130px;
                left: -50px;
            }
    </style>


            @forelse($getSection as $resulta)
                @forelse ($getClass as $key => $name)
                    @if ($resulta->class_id == $name)
                        <x-ux::link icon="graduation-cap" :title="$resulta->name" label="{{ $key }}{{ $resulta->name }} ({{ $resulta->nick_name }})" class="btn btn-primary btn-sm" href="?luppy={{ $resulta->id }}"/>
                    @endif
                @empty
                        <p>kindly add classes</p>
                @endforelse
            @empty
                <p>kindly add class sections</p>
            
            @endforelse
 

<br><br>

        @foreach($users as $user)
        <div style="width:305px; float:left; page-break-inside: avoid; page-break-outside: avoid;">
         <div class="id-card-holder">
            <div class="id-card">
                <table>
                    <tr>
                        <td>
                            <img src="{{ url('../assets/images/logo.png') }}" width="50px" circle/>
                        </td>
                        <td>
                        <center>
                            <span style="font-size: 13px;" align="center">
                            {{ strtoupper('\App\Components\Schools\Save'::getSchool(Auth::user()->school_id)[0]->name) }}</span>
                        </center>
                        </td>
                    </tr>	
                </table>			
                <div class="header">				
                </div>
                <div class="photo">
                    @php           
                    $path_to_file ='assets/images/users/'.$user->id.'.jpg';     
                    @endphp 
                        @if (File::exists(public_path($path_to_file)))
                            <img src="{{ url($path_to_file) }}" circle/>
                        @else
                            <img src="{{ url('../assets/images/users/user.jpg') }}" circle/>
                        @endif
                        
                </div>
                <br>
                <h2><b>{{ strtoupper($user->name) }} </b></h2>
                <br>
            @foreach ($getClass as $key => $name)
                @if ($user->class_id == $name)
                    <h3> {{ strtoupper($key) }} </h3>                   
                @endif
            @endforeach

            @if ($user->sex !='')
                <h3> {{ strtoupper($user->sex) }} </h3>
            @else
                <h3> Nil </h3>                
            @endif

            @if ($user->roll !='')
                <h3> {{ strtoupper($user->roll) }}</h3>
            @else
                <h3> Nil </h3>                
            @endif

                
                <hr>
                 <p style="color: #062f88;"><strong>EDUmix Cards</strong> <p>
            </div>
        </div>
        <br/>
        <div class="id-card-holder">
            <div class="id-card">			
                <div class="header">	
                    <h3>Property of <b>
                            {{ strtoupper('\App\Components\Schools\Save'::getSchool(Auth::user()->school_id)[0]->name) }} </b></h3>				
                </div>			
                <h6> Report loss of card immediately. <br> 
                    This card must be returned uponrequest and surrendered at the end of this session.
                    <br>
                    Possession is mandatory while in school.
                </h6>
        
                <h6>
                    <small>42, Oluyombo street, Ikosi-Ketu, Lagos.</small><br>
                    <small>08107770609, 07065949111</small><br>
                    <small>www.regium.com.ng</small>
                </h6>
                <div class="qr-codeback">
            {{-- <center> --}}
                    {{-- <img src="scan.png"> --}} 
            &emsp;        <div class="output" id="output{{ $user->id }}"  style="margin-left:12px;"></div>
            {{-- </center> --}}
            @if ($user->roll !='')
                <small> {{ strtoupper($user->roll) }}</small>
            @else
                <small> Nil </small>                
            @endif

                </div>
            </div>
        </div> 

        <script>
            jQuery(function(){
                jQuery('#output{{ $user->id }}').qrcode("card/?att={{ $user->id }}&s=st");
            })
            </script>

        </div>
        @endforeach 
         
    

    <x-ux::pagination :links="$users"/>
</x-ux::layouts.page>


<script src="{{ url('../assets/js/jquery.qrcode.min.js') }}"></script>