<x-ux::layouts.page :title="__('Dashboard')">
	<style>
		.title{
			background: #fff;
			/* opacity: 0.5; */
		}
		.icon{
			font-size: 25px;
			font-weight: 700;
			color:{{{ session()->get('theme') }}};
		}
		.tile-title{
			position: relative;
			display:block;
			background:rgb(255, 255, 255);
			margin-bottom: 10px;
			border-radius: 20px;
			background-clip: padding-box;
			transition: all 300ms ease-in-out;
		}
	</style>
	
	<div class="row">

            <div class="col-md-4"  >

				@if (Auth::user()->role !="student" && Auth::user()->role !="parent")
				<a href="{{ url('/student') }}"> 
					@endif
                <div class="tile-stats tile-{{ session()->get('theme') }}">
                    <div class="icon"><i class="fa fa-group"></i></div>
                    <div class="num" data-start="0" data-end="{{ $student }}" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3>
						{{ '\App\Components\Dashboard'::get_phrase('student'); }}s
					</h3>
                  <!-- <p>Total Number of students</p>-->
                 </div>

				 @if (Auth::user()->role !="student" && Auth::user()->role !="parent")
				</a>
				@endif
                
            </div>
            <div class="col-md-4" >
				@if (Auth::user()->role !="student" && Auth::user()->role !="parent")
				<a href="{{ url('/teacher') }}"> 
					@endif

                <div class="tile-stats tile-{{ session()->get('theme') }}">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num" data-start="0" data-end="{{ $teacher }}" 
                    		data-postfix="" data-duration="800" data-delay="0">0</div>
                    
                    <h3>{{ '\App\Components\Dashboard'::get_phrase('teacher'); }}s</h3>
                 <!--  <p>Total Number of teachers</p>-->
                </div>

				@if (Auth::user()->role !="student" && Auth::user()->role !="parent")
					</a>
					@endif
                
            </div>
            <div class="col-md-4" style=" background-color:#fff;">
				@if (Auth::user()->role !="student" && Auth::user()->role !="parent")
            <a href="{{ url('/parent') }}"> 
				@endif

                <div class="tile-stats tile-{{ session()->get('theme') }}">
                    <div class="icon"><i class="entypo-user"></i></div>
                    <div class="num" data-start="0" data-end="{{ $parent }}" 
                    		data-postfix="" data-duration="500" data-delay="0">0</div>
                    
                    <h3>{{ '\App\Components\Dashboard'::get_phrase('parent'); }}s</h3>
                </div>
				@if (Auth::user()->role !="student" && Auth::user()->role !="parent")
			</a>
					@endif
					
                
            </div>
		
            </div>		
				
<br><br><br>
@if (Auth::user()->role !="student" && Auth::user()->role !="parent")

<div class="row">
	<div class="col-md-8">
		
		@php
			$ct='\App\Components\Attendances\index'::countAtt();
			if($ct>0){
				$per=($ct/$student)*100;
			}else {
				$per=0;
			}
		@endphp
		<center>
			Attendance Today: {{ date('Y-m-d') }}
			<x-ux::progress percent="{{ $per }}" color="primary" label="{{ '\App\Components\Attendances\index'::countAtt() }} Students" animated striped/>
		</center>
		<br>
		<br>
		<div class="row">
		<div class="col-md-3 col-sm-6">			
			
			<div class="tile-title tile-primary">
				<div class="icon">
					<x-ux::link icon="user fa-4x" :title="__('Add New Student')" click="$emit('showModal', 'users.save')"/>
				</div>
				<div class="title">
					<h3>New Student</h3>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6">
		<div class="tile-title tile-primary">
			<div class="icon">
				<x-ux::link icon="edit fa-4x" :title="__('Input Result')" href="{{ url('/results') }}/0"/>
			</div>
			<div class="title">
				<h3>Input Result</h3><br>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-6">
		<div class="tile-title tile-primary">
			<div class="icon">
				<x-ux::link icon="scroll fa-4x" :title="__('Affective Trait')" href="{{ url('/affectives') }}/0"/>
			</div>
			<div class="title">
				<h3>Affective Trait</h3>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-6">
		<div class="tile-title tile-primary">
			<div class="icon">
				<x-ux::link icon="calendar-check fa-4x" :title="__('Attendance')" href="{{ url('/attendances') }}/0"/>
			</div>
			<div class="title">
				<h3>Attendance</h3><br>
			</div>
		</div>
	</div>
</div>
<br/><br/> 

<div class="row">
	@foreach($classes as $row)
		<div class="col-md-2 col-sm-4">
			<a href="{{ url('/studentclass') }}/{{ strtoupper($row->name) }}">
			<div class="tile-title ">
				<div class="icon">
				<small>	{{ strtoupper($row->name) }}</small>
				</div>
			</div>
		</a>
		</div>
	@endforeach
		
</div>

</div>

@endif


@if (Auth::user()->role !="student" && Auth::user()->role !="parent")
	<div class="col-md-4" style=" background-color:#fff;">
@else
	<div class="col-md-12" style=" background-color:#fff;">
@endif


    	<div class="row">
			
            <div class="col-md-12 col-xs-12">    
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
					<a href="{{ url('/noticeboards') }}">
                        <div class="panel-title">
                            <i class="fa fa-calendar"></i>
							{{ '\App\Components\Dashboard'::get_phrase('event_schedule'); }}
                        </div>
					</a>
                    </div>
					 
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body"> 
                                <div id="notice_calendar"></div> 
                            </div>
                        </div>
                    </div>
					 
                </div>
            </div>
        </div>
    </div>
                
    	</div>



 <script>
  $(document).ready(function() {
	  
	  var calendar = $('#notice_calendar');
				
				$('#notice_calendar').fullCalendar({
					header: {
						left: 'title',
						// left: 'today prev,next'
						right: 'prev,next'
					},
					
					//defaultView: 'basicWeek',
					
					editable: false,
					firstDay: 1,
					height: 319,
					droppable: false,
					
					events: [
						<?php 
						foreach($notices as $row):
						?>
						{
							title: "{{ $row->notice_title }}",
							start: new Date({{ date('Y',$row->created_timestamp) }},{{ date('m',$row->created_timestamp)-1}}, {{ date('d',$row->created_timestamp) }}),
							end:	new Date({{ date('Y',$row->created_timestamp) }}, {{ date('m',$row->created_timestamp)-1 }},  {{ date('d',$row->created_timestamp) }}) 
						},
						<?php 
						endforeach
						?>
						
					]
				});
	});
  </script> 

</x-ux::layouts.page>