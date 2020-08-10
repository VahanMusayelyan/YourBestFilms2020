<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Site\AppController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Redirect;


class RegisterController extends AppController {
   
    public function index(Request $request) {

        $validatedData = $request->validate([
            'email' => ['unique:App\User,email', 'required'],
            'password' => [ 'required'],
            'name' => [ 'required'],
            're_password' => [ 'required']            
        ]);
        
        $password = $request->password;
        $re_password = $request->re_password;
        
        if($password !== $re_password){
            return Redirect::back()->with('error', 'Пароли не совпадают');
        }
        $data= new User;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = $request->password;
        $data->save();
    
        return back()->with('success', 'Вы успешно зарегистрированы');
       
    }
    
    
    

}
