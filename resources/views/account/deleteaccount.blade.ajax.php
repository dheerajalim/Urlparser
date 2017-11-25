

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/deleteaccount_operation') }}">
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
                    
                




