<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Film;

class ListController extends AppController {

     
     public function listsecond (Request $request) {
         
        $like = "";
        $dislike = "";
        $result = Film::paginate(12);
        $count = count(Film::all());
        $list = 2;
     

        foreach ($result as $key => $value) {
            $film_id = $value->id;

            $like = DB::table('liked_disliked_films')->where([
                        ['film_id', '=', $film_id],
                        ['status', '=', 1]
                    ])->get()->toArray();
            $result[$key]['like'] = count($like);

            $dislike = DB::table('liked_disliked_films')->where([
                        ['film_id', '=', $film_id],
                        ['status', '=', 0]
                    ])->get()->toArray();
            $result[$key]['dislike'] = count($dislike);
            
            $category = DB::table('films_categories')->where([
                        ['film_id', '=', $film_id]])->leftJoin('categories', 'films_categories.category_id', '=', 'categories.id')->get()->toArray();
            
            $country = DB::table('films_countries')->where([
                        ['film_id', '=', $film_id]])->leftJoin('countries', 'films_countries.country_id', '=', 'countries.id')->get()->toArray();
            
            $result[$key]['countries'] = $country;
            $result[$key]['categories'] = $category;

            
        }
        

        return view('site.welcome', ['result' => $result, 'count' => $count,'list'=>$list]);


         
     }

}
