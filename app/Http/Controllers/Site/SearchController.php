<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Film;

class SearchController extends AppController {

     
     public function search (Request $request) {
         
        $like = "";
        $dislike = "";
        $count = count(Film::all());
        $list = 2;
        $search = $request->search;
        

        $result = Film::where('nameEng', 'like', '%'.$search.'%')->orWhere('nameRus', 'like', '%'.$search.'%')->orWhere('description', 'like', '%'.$search.'%')->paginate(10);
        
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
        
        return view('site.search', ['result' => $result, 'count' => $count,'list'=>$list,'search'=>$search]);


         
     }

}
