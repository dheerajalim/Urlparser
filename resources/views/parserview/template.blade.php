@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Enter the URL</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="GET" action="{{ url('/parseurl') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">URL:</label>

                            <div class="col-md-6">
                 
                                <input id="url" type="text" class="form-control" name="url" value="{{ $url != NULL ? $url : old('url')  }}" placeholder ='Enter URL to parse'>
                                
                                
                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Parse
                                </button>
                                

                               
                            </div>
                        </div>
                       
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
     @if ($summary != NULL)
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/balloon-css/0.5.0/balloon.min.css">  <!-- CSS for the Tooltip -->
        <div class="form-group">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/download') }}">
              {{ csrf_field() }}
                  <label for="comment">Summary:</label>
                <div>
                    <div class="form-check" style="float:left">
                        @php $modi_download = 'Select this option in order to download the modified PDF after the changes you have made in the parsed URL' @endphp
                       
                        <label class="form-check-label" data-balloon="{{$modi_download}}" data-balloon-pos="right" data-balloon-length="medium">
                          <input type="checkbox" class="form-check-input " name="modifieddownload" value="Yes">
                          Download Modified
                        </label>
                    </div>
                    
                    <div class="text-right">
                     
                         
                         <!--a href="{{ url('/download') }}" id="download" 
                         onclick="alert('Your Download will start now. This make take some time depending upon the page size')"
                         > Download PDF </a-->
                            
                           <button data-balloon="Download's the PDF for you" data-balloon-pos="up" data-balloon-length="small" type="submit" class="btn btn-primary"><i class="fa fa-btn fa-download"></i>
                           PDF
                           </button>
                                  

                     </div>
                </div>
                  <input type="hidden" value="{{ $url != NULL ? $url : old('url')  }}" name="downloadurl">
                  <textarea id="summary_text" class="form-control" name="summary_text" value="{{ old('summary_text') }}" rows='20'>{{ $summary }}</textarea>
            </form>
        </div>
    @endif
    
</div>



@endsection
@push('js')

@endpush