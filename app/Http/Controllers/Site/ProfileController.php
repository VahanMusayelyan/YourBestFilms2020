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
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller {

    public function index() {

        $id = Session::get('role');
       
        if($id == null){
            abort(404);
        }
        $user = User::find($id)->toArray();
        $like = DB::table('liked_disliked_films')->where([
                            ['liked_disliked_films.user_id', '=', $id],
                            ['liked_disliked_films.status', '=', 1]
                        ])->leftJoin('films', 'liked_disliked_films.film_id', '=', 'films.id')->get()->toArray();
        $dislike = DB::table('liked_disliked_films')->where([
                            ['liked_disliked_films.user_id', '=', $id],
                            ['liked_disliked_films.status', '=', 0]
                        ])->leftJoin('films', 'liked_disliked_films.film_id', '=', 'films.id')->get()->toArray();
        $later = DB::table('later_films')->where([
                            ['later_films.user_id', '=', $id]
                        ])->leftJoin('films', 'later_films.film_id', '=', 'films.id')->get()->toArray();
        $watched = DB::table('watched_films')->where([
                            ['watched_films.user_id', '=', $id]
                        ])->leftJoin('films', 'watched_films.film_id', '=', 'films.id')->get()->toArray();


        return view('site.profile', ['user' => $user, 'like' => $like, 'dislike' => $dislike, 'later' => $later,'watched' => $watched]);
    }
    
    public function update(Request $request) {
        $validatedData = $request->validate([
            'email' => ['unique:App\User,email', 'required'],
            'updatename' => [ 'required'],         
        ]);

        $id = Session::get('role');
        $user = User::find($id);
        if(isset($request->updateprofile)){
            $img = $request->updateprofile;
            $fname = $img->getClientOriginalName();
            $img->storeAs('public/upload/users', $fname);
            $user->avatar = $fname;
        }
        $user->name = $request->updateemail;
        $user->email = $request->updatename;
        $user->save();
        
        return redirect()->route('profile');
    }

}
