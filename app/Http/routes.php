<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/upt', function () {
    return view('index');
});

Route::get('/template',[ 
    
    
    'as' => 'template_route',
    'uses' => 'Parser\ParserController@template',
    
    ]);

/*
Route::get('/logins', [
    
    'as' => 'login_route',
    'uses' => 'LoginController@index',
    
    ]);
    
Route::post('/login_check', [
    
    'as' => 'login_check_route',
    'uses' => 'LoginController@loginCheck',
    ]
);
*/

//  Auth route starts
Route::get('auth/{authmode}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{authmode}/callback', 'Auth\AuthController@handleProviderCallback');
//  auth route ends


Route::group(['middleware' => 'revalidate'],function(){
	Route::auth();
	Route::get('/', function () {
    return view('index');
    })->name('index');
    
    Route::get('/upt', function () {
        return view('index');
    });
    
    Route::get('/template',[ 
        
        
        'as' => 'template_route',
        'uses' => 'Parser\ParserController@template',
        
        ]);
    
    Route::get('/parseurl',[ 
        
        
        'as' => 'parseurl_route',
        'uses' => 'Parser\ParserController@parseurl',
        
        ]);
    /*
    Route::post('/parseurl',[ 
        
        
        'as' => 'parseurl_route',
        'uses' => 'Parser\ParserController@parseurl',
        
        ]);
    */    
    Route::post('/download',[
        
        'as' => 'download_route',
        'uses' =>'Parser\ParserController@download',
        
        ]);
    
    Route::get('/download',[
        
        'as' => 'download_route_get',
        'uses' =>'Parser\ParserController@download',
        
        ]);
    
    
    Route::get('/accountsettings',function () {
        if (Auth::check()){
                
                return view('account.accountsettings');
            }
            
        else{
                
                flash()->error('Please login first');
                return redirect('/login');
            }
    });
    
     Route::get('/editaccount',function () {
        if (Auth::check()){
                
                return view('account.editaccount');
            }
            
        else{
                
                flash()->error('Please login first');
                return redirect('/login');
            }
    });
     Route::get('/deleteaccount',function () {
         if (Auth::check()){
                
                return view('account.deleteaccount');
            }
            
        else{
                
                flash()->error('Please login first');
                return redirect('/login');
            }
    });
     Route::get('/changepassword',function () {
        if (Auth::check() and  Auth::user()->provider==NULL){
            
            return view('account.changepassword');
        }
        elseif(Auth::check() and  Auth::user()->provider!=NULL){
            
            $error_message = 'You have registered using <b>'.Auth::user()->provider.
                '.</b><br> You are not authorized to change account password';
            
            flash()->overlay($error_message, 'Error');
            
            return redirect('/editaccount');
        }
        
        else{
            
            flash()->error('Please login first');
            return redirect('/login');
        }
    });

    
    
       
    Route::post('/editaccount_operation',[
        
        'as' => 'account_route',
        'uses' => 'Account\AccountController@EditAccount',
        
        ]);
    
    
     Route::get('/deleteaccount_operation',[
        
        'as' => 'deleteaccount_route',
        'uses' => 'Account\AccountController@DeleteAccount',
        
        ]);
    
     Route::post('/changepassword_operation',[
        
        'as' => 'changepassword_route',
        'uses' => 'Account\AccountController@ChangePassword',
        
        ]);
        
    // Custom Error Page
    
    Route::get('/pageerror/{err_code?}',function($err_code = ''){
        
        return view('errors.errorpage',compact('err_code'));
    }
     );
    

});



