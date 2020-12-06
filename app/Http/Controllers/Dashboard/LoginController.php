<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\AppController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller {

    public function index() {
        
        return view('dashboard.auth.login');
    }
    
    
    public function login(Request $request){
                
//        $admin = $request->only(['email', 'password']);
     
        
//        if (Auth::attempt($admin) && Auth::user()->is_admin == 1 ) {
           
            return redirect()->intended('/admin');
//        }else{
//            return redirect()->intended('/admin/auth');             
//        }
        
    }
    
    
        public function logout(){
            return route('main');
        }

}
