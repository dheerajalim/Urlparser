
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/changepassword_operation') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">New Password</label>
                      
                            <div class="col-md-6">
                 
                                <input id="password" type="password" class="form-control" name="password" value="" placeholder ='Enter New Password'>
                                
                                
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                      
                            <div class="col-md-6">
                 
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="" placeholder ='Enter Confirm Password'>
                                
                                
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                        </div>
                        
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Change Password
                                </button>
                                

                               
                            </div>
                        </div>
                       
                    </form>

           