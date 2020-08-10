<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class WatchAjaxController extends AppController {

     public function watch(Request $request) {
         

        if (Session::has('role') & Session::has('name')) {
            $film_id = $request->id;
            $user_id = Session::get('role');
            
            $result = DB::table('watched_films')->where([
                        ['user_id', '=', $user_id],
                        ['film_id', '=', $film_id]
                    ])->get()->toArray();

            if (count($result) > 0) {
                DB::table('watched_films')->where([
                    ['user_id', '=', $user_id],
                    ['film_id', '=', $film_id]
                ])->delete();
                
            } else {
                DB::table('watched_films')->insert([
                    'user_id' => $user_id,
                    'film_id' => $film_id,
                    'watched' => 1,
                ]);
            }
            
            return "1";
        } else {
            return "0";;
        }
  
         
     }

}
