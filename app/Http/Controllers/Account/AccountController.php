<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

use App\Http\Requests\EditAccount;
use App\Http\Requests\PasswordChange;
use Auth;
use Flash;

class AccountController extends Controller
{
    public function EditAccount(EditAccount $request){
        
        if (Auth::check() and !empty($request->name) and !empty($request->email)){
            
            if(Auth::user()->name != $request->name){
                
                Auth::user()->name = $request->name;
                Auth::user()->save();
                
                flash()->success('Details Updated Sucessfully!');
                return redirect('/editaccount');
               
            }
            
            elseif(Auth::user()->name == $request->name){
                flash()->error('No changes found to update!');
                return redirect('/editaccount');
            }
            
            else{
                flash()->error('Details cannot be updated');
                return redirect('/editaccount');
            }
        }
        
        else{
            
            flash()->error('Please login first');
            return redirect('/login');
        }
    }
        public function DeleteAccount(){
        
        if (Auth::check()){
            
            Auth::user()->delete();
            flash()->success('You account has bee deleted successfully!');
            return redirect('/login');
            
        }
        
        else{
            
            flash()->error('Please login first');
            return redirect('/login');
        }
    }
        public function ChangePassword(PasswordChange $request){
        
        if (Auth::check() and !empty($request->password) and !empty($request->password_confirmation)){
            

                
            if(Hash::check($request->password, Auth::user()->password)) {
                flash()->error('New password cannot be same as old password');
                return redirect('/changepassword');
                
               
                }
                
            else{
                
                Auth::user()->password = bcrypt($request->password);
                Auth::user()->save();
                
                
                return redirect('/logout');
                

               
            }
            
  
        }    
        
        
        else{
            
            flash()->error('Please login first');
            return redirect('/login');
        }
            
                           
       
    }
}

