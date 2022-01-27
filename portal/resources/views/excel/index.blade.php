<?php
// {{ Session::get('suj') }} | {{ Session::get('classn') }} {{ Session::get('scn') }}

if (Session::get('suj')=='' || Session::get('classn') =='' || Session::get('scid')=='' || Session::get('scid')<=0) {
    header('location:/results/0');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet"> --}}
  <link href="{{ url('assets/css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ url('assets/css/neon-core.css') }}" rel="stylesheet">
  <link href="{{ url('assets/css/neon-forms.css') }}" rel="stylesheet">
  <title>Upload Result</title>
</head>
<body>
  



  
<div class="container" style="margin-top: 5rem;">
  <center>
    @if($message = Session::get('success'))
        <div class="alert alert-info alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <strong>Success!</strong> {{ $message }}
        </div>
    @endif
    {!! Session::forget('success') !!}
    <br />
    <h2 class="text-title">Import Excel/CSV</h2>
    <div>{{ Session::get('suj') }} | {{ Session::get('classn') }} {{ Session::get('scn') }}</div> <br><br><br>

    
    @php
      $nm=Session::get('classn').Session::get('scn').'_ScoreSheet_'.Session::get('suj');
    @endphp

    <a href="{{ route('exportExcel', $nm) }}">
    <button class="btn btn-primary">Download Template for {{ Session::get('suj') }} - {{ Session::get('classn') }} {{ Session::get('scn') }}</button></a>
  </center>
    {{-- <a href="{{ route('exportExcel', 'xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
    <a href="{{ route('exportExcel', 'xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a> --}}

    {{-- <a href="{{ route('exportExcel', $nm) }}"><button class="btn btn-success">Download CSV</button></a> --}}

    <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ url('/importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" name="import_file" /> <br/><br/><br/>
        <button class="btn btn-success">Import File</button>
    </form>

    <br><br>
<center>
  <a href="{{ url('/results') }}/{{ session()->get('scid') }}?view={{ session()->get('sb') }}">
    <button icon="arrow-back" class="btn btn-danger btn-md">Back </button>
  </a>
</center>

</div>
   
{{-- {{ $data }} --}}

</body>
</html>
{{-- </x-ux::layouts.page> --}}