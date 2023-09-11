@extends('layout.master')
@section('title') Dashboard @endsection
@section('current-header') Dashboard @endsection
@section('active-page') Dashboard @endsection

@section('content')
 
      <div class="row">
        @if ($message = Session::get('message'))
            <div class="alert panel-success " style="margin-bottom:10px">
                <div class="panel-heading"  style="color:white;" > {{ $message }}  <button type="button" class="close pull-right" data-dismiss="alert" aria-hidden="true" style="color:white;">&times;</button></div>
            </div>
        @endif
       
      </div><!-- row -->
      
     
      

@endsection