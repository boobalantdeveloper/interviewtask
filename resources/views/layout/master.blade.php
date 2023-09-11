<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('title','Dashboard') | Product Management</title>
  <link href="{{ asset('css/style.default.css')}}" rel="stylesheet">
    <link href="{{ asset('css/jquery.datatables.css')}}" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('css/jquery.tagsinput.css')}}" />
  <link rel="stylesheet" href="{{ asset('css/jquery.tagsinput.css')}}" />
  <link rel="stylesheet" href="{{ asset('css/select2.css')}}" />
 @yield('extra-css')
</head>

<body>
<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
@include('layout.partial.sidebar')
  <div class="mainpanel">
   @include('layout.partial.navbar')
    
    <div class="pageheader">
      <h2><i class="fa fa-home"></i> @yield('current-header','Dashbaord')</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="">Dashboard</a></li>
          <li class="active">@yield('active-page')</li>
        </ol>
      </div>
    </div>
    <div class="contentpanel">
     @yield('content')      
    </div><!-- contentpanel --> 
    <!-- @include('layout.partial.footer')     -->
  </div><!-- mainpanel -->

</section>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<script src="{{ asset('js/jquery-1.11.1.min.js')}}"></script>
<script src="{{ asset('js/jquery-migrate-1.2.1.min.js')}}"></script>
<script src="{{ asset('js/jquery-ui-1.10.3.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/modernizr.min.js')}}"></script>
<script src="{{ asset('js/jquery.sparkline.min.js')}}"></script>
<script src="{{ asset('js/toggles.min.js')}}"></script>
<script src="{{ asset('js/retina.min.js')}}"></script>
<script src="{{ asset('js/jquery.cookies.js')}}"></script>
@if(request()->is('/'))
<script src="{{ asset('js/flot/jquery.flot.min.js')}}"></script>
<script src="{{ asset('js/flot/jquery.flot.resize.min.js')}}"></script>
<script src="{{ asset('js/flot/jquery.flot.spline.min.js')}}"></script>
<script src="{{ asset('js/morris.min.js')}}"></script>
<script src="{{ asset('js/raphael-2.1.0.min.js')}}"></script>
@endif
<script src="{{ asset('js/custom.js')}}"></script>
@if(request()->is('/'))
<script src="{{ asset('js/dashboard.js')}}"></script>
@endif
<script src="{{ asset('js/jquery.datatables.min.js')}}"></script>
<script src="{{ asset('js/select2.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js"></script>
@yield('script')
</body>
</html>
