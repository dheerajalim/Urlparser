@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ url('/editaccount') }}" class="btn btn-info" role="button" style="margin-right:5%">Edit Account</a>
                  
                    @if(Auth::user()->provider==NULL)
                        <a href="{{ url('/changepassword') }}" class="btn btn-info" role="button" style="margin-right:5%" >Change Password</a>
                    
                    @endif
                    
                    <a href="{{ url('/deleteaccount') }}" class="btn btn-danger" role="button" style="margin-right:5%">Delete Account</a>
                    
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-10 control-label">
                                
                                This will delete your account permanently. Are you sure you want to Delete your account?
                            </label>

                
                        </div>



                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-8">
                                 <a href="{{ url('/deleteaccount_operation') }}" class="btn btn-primary" role="button" >
                                      <i class="fa fa-btn fa-check"></i> Yes
                                </a>
                                
                                

                               
                            </div>
                        </div>
                       
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    
</div>



@endsection
@push('js')

@endpush