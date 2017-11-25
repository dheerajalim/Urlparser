@extends('layouts.app')

@section('content')


<script>
function Account(str) {
        document.getElementById(str).classList.add('fa');
        document.getElementById(str).classList.add('fa-refresh');
        document.getElementById(str).classList.add('fa-spin');
        document.getElementById(str).classList.add('fa-fw');
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("accountdiv").innerHTML = this.responseText;
                document.getElementById(str).classList.remove('fa');
                document.getElementById(str).classList.remove('fa-refresh');
                document.getElementById(str).classList.remove('fa-spin');
                document.getElementById(str).classList.remove('fa-fw');
            }
        };
        xmlhttp.open("GET",str,true);
        xmlhttp.send();
    
}
</script>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <!--a href="{{ url('/editaccount') }}" class="btn btn-info" role="button" style="margin-right:5%">Edit Account</a-->
                    <button onclick="Account('editaccount')" class="btn btn-info" style="margin-right:5%">
                        Edit Account <i class="" aria-hidden="true" id="editaccount"></i>
                        </button>
                
                    @if(Auth::user()->provider==NULL)
                        <!--a href="{{ url('/changepassword') }}" class="btn btn-info" role="button" style="margin-right:5%" >Change Password</a-->
                        <button onclick="Account('changepassword')" class="btn btn-info" style="margin-right:5%" >
                            Change Password<i class="" aria-hidden="true" id="changepassword"></i>
                            </button>
                    @endif 
                    
                    
                    <!--a href="{{ url('/deleteaccount') }}" class="btn btn-danger" role="button" style="margin-right:5%">Delete Account</a-->
                     
                     <button onclick="Account('deleteaccount')" class="btn btn-danger" style="margin-right:5%">
                         Delete Account<i class="" aria-hidden="true" id="deleteaccount"></i>
                         </button>
                     
                </div>
                <div class="panel-body" id="accountdiv">
                  <!-- The AJAX works here -->
                  <p>Select an option to proceed</p>  
                </div>
            </div>
        </div>
    </div>

    
</div>



@endsection
@push('js')

@endpush