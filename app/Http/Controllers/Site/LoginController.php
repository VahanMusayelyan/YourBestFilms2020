<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\AppController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Film;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller {

    public function index() {
        
    }

    public function login(Request $request) {
        $count = count(Film::all());
        $email = $request->email;
        $password = $request->password;
        $list = 1;

        $user = User::where([
                        ['email', $email],
                        ['password', $password]
                ])->get()->toArray();




        if (count($user) > 0) {
            $request->session()->put('role', $user[0]['id']);
            $request->session()->put('name', $user[0]['name']);

            $ses = $request->session()->get('role');
            $name = $request->session()->get('name');


            $result = Film::paginate(12);
            
            return redirect()->route('main');
            
//            return view('site.welcome', ['result' => $result, 'user' => $user, 'ses' => $ses, 'name' => $name, 'count' => $count, 'list' => $list]);
        } else {
            return redirect()->back()->with('error', 'Логин / пароль не правильно');;
        }
    }

    public function logout() {

        Session::flush();

        return redirect('/');
    }

}
