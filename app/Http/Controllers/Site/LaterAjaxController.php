<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class LaterAjaxController extends AppController {

     public function later(Request $request) {
         
        if (Session::has('role') & Session::has('name')) {
            $film_id = $request->id;
            $user_id = Session::get('role');
            
            $result = DB::table('later_films')->where([
                        ['user_id', '=', $user_id],
                        ['film_id', '=', $film_id]
                    ])->get()->toArray();

            if (count($result) > 0) {
                DB::table('later_films')->where([
                    ['user_id', '=', $user_id],
                    ['film_id', '=', $film_id]
                ])->delete();
                
            } else {
                DB::table('later_films')->insert([
                    'user_id' => $user_id,
                    'film_id' => $film_id,
                    'later' => 1,
                ]);
            }
            
            return "1";
        } else {
            return "0";;
        }
  
         
     }

}
