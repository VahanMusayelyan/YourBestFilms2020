<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class LikeDislikeAjaxController extends AppController {

    public function like(Request $request) {
        

        if (Session::has('role') & Session::has('name')) {
           
            $film_id = $request->id;
            $user_id = Session::get('role');
            $value = $request->value;
            
            
            $result = DB::table('liked_disliked_films')->where([
                        ['user_id', '=', $user_id],
                        ['film_id', '=', $film_id]
                    ])->get()->toArray();
            
            
            if (!empty($result)) {

                if($result[0]->status == $value){
                    
                    $result = DB::table('liked_disliked_films')->where([
                        ['user_id', '=', $user_id],
                        ['film_id', '=', $film_id]
                    ])->delete();
                    
                     return "2";
                    
                }else{
                     DB::table('liked_disliked_films')->where([
                    ['user_id', '=', $user_id],
                    ['film_id', '=', $film_id]
                ])->update([
                    'user_id' => $user_id,
                    'film_id' => $film_id,
                    'status' => $value,
                ]);
                    
                }
                
                 return "1";
               
            } else {
                
                DB::table('liked_disliked_films')->insert([
                    'user_id' => $user_id,
                    'film_id' => $film_id,
                    'status' => $value,
                ]);
                
                              
                return "1";
            }
            
        } else {
           return "0";
        }
    }
 

}
