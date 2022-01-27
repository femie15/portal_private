@section('title')
    @yield('title')
@endsection
@php 
    $page_name =  strtolower(e($__env->yieldContent('title')));
    $class_id=3;
@endphp

@foreach ($settings as $setting) 
    @if ($setting->type=='skin_colour')
        @php
            $color=$setting->description;
        @endphp
    @endif
@endforeach

<div class="sidebar-menu">
  <header class="logo-env" >

      <!-- logo -->
      <div class="logo" style="">
          <a href="">
              <img src="../assets/images/logo.png"  style="max-height:70px;"/>
          </a>
      </div>

      <!-- logo collapse icon -->
      <div class="sidebar-collapse" style="">
          <a href="#" class="sidebar-collapse-icon with-animation">
              <i class="entypo-switch"></i>
          </a>
      </div>

      <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
      <div class="sidebar-mobile-menu visible-xs">
          <a href="#" class="with-animation">
              <i class="entypo-menu"></i>
          </a>
      </div>
  </header>

  <div style=""></div>	
  <ul id="main-menu" class="">
      <!-- add class "multiple-expanded" to allow multiple submenus to open -->
      <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
     

      <!-- DASHBOARD -->
      <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?>">
          <a href="{{ url('/dashboard') }}">
            {{-- {{ $page_name }} --}}
              <i class="entypo-gauge"></i>              
              <span>{{ __('dashboard') }}</span>
          </a>
      </li>

@if (Auth::user()->role !="student" && Auth::user()->role !="parent")
      <!-- STUDENT -->
      <li class="<?php
      if ($page_name == 'add student' ||
              $page_name == 'student_bulk_add' ||
              $page_name == 'student_information' ||
              $page_name == 'student_marksheet')
          echo 'opened active has-sub';
      ?> ">
          <a href="#">
              <i class="fa fa-group"></i>
              <span>{{ __('student') }}</span>
          </a>
          <ul>      

              <!-- STUDENT INFORMATION -->
              <li class="<?php if ($page_name == 'student' || $page_name == 'student_marksheet') echo 'opened active'; ?> ">
                  <a href="#">
                      <span><i class="entypo-database"></i>Students Class Records</span>
                  </a>
                  <ul>
                    @forelse ($classes as $row)
                        <li class="<?php  if ($page_name == 'student' || $page_name == 'student_marksheet' || $page_name == 'studenclass') echo 'active'; ?>"> 
                            <a href="{{ url('/studentclass') }}/{{ $row->name}}">
                                <span>{{ $row->name }}</span>
                            </a>
                        </li>
                    
                        <li class="<?php  if ($page_name == 'Student') echo 'active'; ?>">
                        <a href="{{ url('/student') }}">
                            <span>{{ __('View All Students') }}</span>
                            </a>
                        </li>

                    @empty
                        <li class="<?php  if ($page_name == 'Class') echo 'active'; ?>">
                            <a href="{{ url('/classeds') }}">
                                <span>{{ __('Manage Classes') }}</span>
                            </a>
                        </li>
                    @endforelse

                  </ul>
              </li>              
          </ul>
      </li>

      <!-- TEACHER -->
      <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
          <a href="{{ url('/teacher') }}">
              <i class="entypo-users"></i>
              <span>{{ __('teachers') }}</span>
          </a>
      </li>

      <!-- PARENTS -->
      <li class="<?php if ($page_name == 'parent') echo 'active'; ?> ">
          <a href="{{ url('/parent') }}">
              <i class="entypo-user"></i>
              <span>{{ __('parents') }}</span>
          </a>
      </li>
@endif

      <!-- EXAMS -->
      <li class="<?php
      if ($page_name == 'results' ||
            $page_name == 'grade' ||
            $page_name == 'marks' ||
                $page_name == 'exam_marks_sms' ||
                    $page_name == 'tab' ||
                    $page_name == 'study' ||
                    $page_name == 'eLibrary' ||
                    $page_name == 'topics')
                          echo 'opened active';
      ?>"> 
          <a href="#">
              <i class="entypo-graduation-cap"></i>
              <span>{{ __('Academics') }}</span>
          </a>
          <ul>
            
@if (Auth::user()->role !="student" && Auth::user()->role !="parent")
            <li class="<?php if ($page_name == 'results') echo 'active'; ?> ">
                <a href="{{ url('/results') }}/0">
                    <i class="entypo-calendar"></i>
                    <span>Record students mark</span>
                </a>
            </li>
            <li class="<?php if ($page_name == 'tab') echo 'active'; ?> ">
                <a href="{{ url('/tabulation') }}">
                    <i class="entypo-layout"></i>
                    <span>Tabulation Sheet</span>
                </a>
            </li>
               <li class="<?php if ($page_name == 'topics') echo 'active'; ?> ">
                  <a href="{{ url('/topics') }}">
                      <i class="entypo-book"></i>
                      <span>{{ __('Lesson Notes') }}</span>
                  </a>
                </li>
                <li class="<?php if ($page_name == 'Student Access Card') echo 'active'; ?> ">
                   <a href="{{ url('/card') }}/jss1">
                       <i class="entypo-lock"></i>
                       <span>{{ __('Access Cards') }}</span>
                   </a>
                 </li>
@endif


<li>
    <x-ux::link :label="__('Live Class')" icon="video" :title="__('Live Class')" click="$emit('showModal', 'home')" />  
  </li>
  
                <li class="<?php if ($page_name == 'study') echo 'active'; ?> ">
                    <a href="{{ url('/study') }}">
                        <i class="entypo-book-open"></i>
                        <span>{{ __('Read Lesson Notes') }}</span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'eLibrary') echo 'active'; ?> ">
                    <a href="{{ url('/elibrary') }}">
                        <i class="entypo-book"></i>
                        <i class="entypo-book" style="margin-left: -22px;"></i>
                        <span>{{ __('E-Library') }}</span>
                    </a>
                </li>
            
          </ul>
      </li>


@if(Auth::user()->role =="student")
      <li class="<?php if ($page_name == 'results') echo 'opened active'; ?> ">
          <a href="{{ url('/midterm') }}/{{ Auth::user()->id }}">
              <i class="entypo-calendar"></i>
              <span>View Result</span>
          </a>
      </li>
@elseif (Auth::user()->role =="parent")
    <li class="<?php if ($page_name == 'results') echo 'opened active'; ?>"> 
        <a href="#">
            <i class="entypo-graduation-cap"></i>
            <span>{{ __('View Result') }}</span>
        </a>
    <ul>
        @if (count($getParent)>0)
            @foreach ($getParent as $getP)
         <li class="<?php if ($page_name == 'results') echo 'opened active'; ?> ">
                <a href="{{ url('/midterm') }}/{{ $getP->id }}">
                    <i class="entypo-user"></i>
                    <span>{{ $getP->name }}</span>
                </a>
         </li>                
         @endforeach

        @endif

    </ul>
    </li>
@endif

      <!-- NOTICEBOARD -->
      <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
          <a href="{{ url('/noticeboards') }}">
              <i class="entypo-doc-text-inv"></i>
              <span>{{ __('noticeboard') }}</span>
          </a>
      </li>

      <!-- MESSAGE -->
     <li class="<?php if ($page_name == 'messages') echo 'active'; ?> ">
          <a href="{{ url('/messages') }}">
              <i class="entypo-chat"></i>
              <span>{{ __('Chat') }}</span>
          </a>
      </li> 



@if (Auth::user()->role !="student" && Auth::user()->role !="parent")
     <!-- SETTINGS -->
      <li class="<?php
      if ($page_name == 'system_settings' ||
              $page_name == 'manage_language' ||
                  $page_name == 'sms_settings' ||
                  $page_name == 'subjects')
                      echo 'opened active';
      ?> ">
          <a href="#">
              <i class="entypo-lifebuoy"></i>
              <span>{{ __('settings') }}</span>
          </a>
          <ul>
              
    @if ('\App\Components\Schools\Save'::getSchool(Auth::user()->school_id)[0]->id  == '' )
        <li class="<?php if ($page_name == 'subjects') echo 'active'; ?> ">
            <x-ux::link :label="__('School Information')" icon="cog" click="$emit('showModal', 'schools.save')"/>
        </li>
    @else
    <li class="<?php if ($page_name == 'subjects') echo 'active'; ?> ">
        <x-ux::link :label="__('School Information')" icon="cog" click="$emit('showModal', 'schools.save', {{'\App\Components\Schools\Save'::getSchool(Auth::user()->school_id)[0]->id }})"/>
    </li>
    @endif
    
    <li class="<?php if ($page_name == 'terms') echo 'active'; ?> ">
        <a href="{{ url('/terms') }}">
            <span><i class="entypo-calendar"></i>{{ __('Set Term & Session') }}</span>
        </a>
    </li>
                <!-- CLASS ROUTINE -->
    <li class="<?php if ($page_name == 'sections') echo 'active'; ?> ">
        <a href="{{ url('/sections') }}">
            <span><i class="entypo-target"></i>{{ __('Set Class / Sections') }}</span>
        </a>
    </li>

    <li class="<?php if ($page_name == 'subjects') echo 'active'; ?> ">
      <a href="{{ url('/subjects') }}">
          <span><i class="entypo-book"></i>{{ __('Manage Subjects') }}</span>
      </a>
  </li>
  
      <li class="<?php if ($page_name == 'book') echo 'active'; ?> ">
        <a href="book">
          <i class="entypo-picture"></i>
          <span>{{ __('school_logo_principal_signature') }}</span>
        </a>
      </li> 
          </ul>
      </li> 
       
@endif

       <li>
                  <a href="#">
        <i class="entypo-globe"></i>
                      <span>{{ __('School Website') }}</span>
                  </a>
       </li>
       
       <li>
        <a wire:click="logout" style="cursor: pointer;">
            <i class="entypo-logout"></i>
            <span> Logout
            </span>
        </a>
    </li>
  </ul>

  <center>
<x-ux::link icon="video-camera fa-4x" :title="__('Add New Student')" click="$emit('showModal', 'home')"  style="color: rgb(201, 3, 3)"/>

</center>

</div>
    <!-- /.sidebar END-->