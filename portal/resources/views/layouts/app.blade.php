<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name') }}</title>
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/png">
    <link rel="stylesheet" href="../assets/css/font-icons/entypo/css/entypo.css">
    {{-- <link rel="shortcut icon" href="{{ URL::asset('dist/image/logo.gif') }}" />> --}}

    <livewire:styles/>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @guest       
    <style>  
        body{
            background-image:url("../assets/images/showcase_bg.jpg") ;
              background-repeat: no-repeat;
              background-size: cover;
        }
            .sp{
              margin-top:100px;
            }
          .center{
              display:block;
              margin-left: auto;
              margin-right: auto;
              width: 120px;
          }
            
        </style>
        <span class="sp"><a href="/login">
        <img src="{{ url('assets/images/logo.png') }}" alt="Logo" class="center">
    </a>
        </span>
    @else  
    <livewire:layouts.includes_top/>
    @endguest
</head>
<body class="d-flex flex-column h-100 page-body skin-red">
    <div class="page-container" >
        @guest       
        @else  
        <livewire:layouts.sidebar/>
        @endguest
            <div class="main-content">
                @guest       
        @else  
    <livewire:layouts.header/>
    <livewire:layouts.nav/>
    @endguest

    {{-- <h3 style="">
        <i class="entypo-right-circled"></i> 
            @yield('title')
    </h3> --}}

    <main class="flex-shrink-0">
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
              <div class="container-fluid"> 
        {{ $slot }}
                </div>
            </section>
        </div>
    </main>

        </div>
    </div>
    <livewire:layouts.footer/>

    <livewire:loader/>
    <livewire:modal/>
    <livewire:scripts/>
    <script src="{{ mix('js/app.js') }}"></script>
    {{-- @yield('script') --}}
    <livewire:layouts.includes_bottom/>
</body>
</html>
