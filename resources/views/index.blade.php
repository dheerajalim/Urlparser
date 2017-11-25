@extends('layouts.app')

@section('content')
<!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h1 class="mt-5">Parse the URL to get the source and see it on your screen.</h1>
          <p class="lead">Download it as well.</p>
          <a href="{{ url('/template') }}" class="btn btn-lg btn-info">Parse the URL now <span class="glyphicon glyphicon-chevron-right"></span></a>
          
        </div>
      </div>
    </div>
@endsection