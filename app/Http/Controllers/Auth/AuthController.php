<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Support\Facades\Redirect;
use Auth;
use Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Flash;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    
    protected $redirectTo = '/template';
    
    //Redirect after logout
    protected $redirectAfterLogout = '/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {   flash()->success('You have been logged in successfully!');
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    
    
    public function handleProviderCallback($provider, Request $request)
    {   
        if (!$request->has('code') || $request->has('denied')) {
            
            flash()->error('Please Authenticate or Register in order to login');
            return redirect('/login');
            //return back()->withInput();
            
        }
        
        $user = Socialite::driver($provider)->user();
        
        $authUser = $this->findOrCreateUser($user, $provider);
        
       
        if(!$authUser[1]){
            
            if ($authUser[0] !=NULL){
                $error_message = 'You have already registered using <b>'.$authUser[0].
                '.</b><br> Please try logging in using <b>'.$authUser[0]. '</b> account'; 
            }
            
            else{
                $error_message = 'You have already registered. Please try logging in !'; 
            }
            
            flash()->overlay($error_message, 'Error');
            return Redirect::to('/login');
            
        }
        
        Auth::login($authUser[0], true);
        // OAuth Two Providers
        $token = $user->token;
        
        
        flash()->success('You have been logged in successfully!');
        
        //$session->put('logged_userid', $)
        
        return redirect($this->redirectTo);
        
        //$refreshToken = $user->refreshToken; // not always provided
        //$expiresIn = $user->expiresIn;
        
        // OAuth One Providers
        //$token = $user->token;
        //$tokenSecret = $user->tokenSecret;
        
        // All Providers
        $user->getId();
        $user->getNickname();
        $user->name;
        $user->getEmail();
        $user->getAvatar();
        
        
        
        
        
        
        //return view('resume.template', compact('user'));
        
        //return redirect()->route('template_route');
    }
    
    public function findOrCreateUser($user, $provider)
    {   
        if ($authUser = User::where('email',$user->email)->first()){
            
            if($authUser->provider_id == $user->id){
                
                return $login_details = [$authUser,true];
            }
            
            else{
                return $login_details = [$authUser->provider,false];
            }
        }
        
        
        return $login_details =[User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
        ]),true
        ];
    }
    

}
