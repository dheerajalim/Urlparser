@extends('layouts.app')

@section('content')

       

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;font-size:24px">
                   {{$err_code}}, Whoops! Something went wrong
                </div>
                
            </div>
        </div>
    </div>
</div>
 
@endsection