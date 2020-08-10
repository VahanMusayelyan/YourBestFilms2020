<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Film;
use App\FilmsCategory;

class FilterController extends AppController {

    public function filter(Request $request,$year = null, $category = null) {
        $arr = [];
        $like = "";
        $dislike = "";
        $category = $request->category;
        $year = $request->year;
        $year_all = $request->year_all;
        $count = count(Film::all());
        $list = 1;
        
        
        if(empty($category) & empty($year)){
             return redirect()->route('main');
        }

        if (isset($category)) {
            sort($category);
            
            if(!isset($year) && !isset($year_all)) {
                $result = FilmsCategory::whereIn('category_id', $category)->leftJoin('films', 'films.id','=','films_categories.film_id')->groupBy('film_id')->paginate(12); 
            }else{
            
                $result = FilmsCategory::whereIn('category_id', $category)->paginate(12);
                foreach ($result as $key => $value) {
                    $arr[$key] = $value['film_id'];
                }

                if (isset($year) && isset($year_all)) {
                    $year = array_merge($year, $year_all);
                    $year = array_unique($year);
                    $result = Film::whereIn('id', $arr)->whereIn('year', $year)->paginate(12);
                }

                if (isset($year) xor isset($year_all)) {
                    if ($year == null) {
                        $year = $year_all;
                    }
                    $result = Film::whereIn('id', $arr)->whereIn('year', $year)->paginate(12);
                }
            }
            
            $category = DB::table('categories')->whereIn('id',$category)->get();
        
            
            
            
           
            
            
        } else {

            if (isset($year) && isset($year_all)) {
                $year = array_merge($year, $year_all);
                $year = array_unique($year);
                $result = Film::whereIn('year', $year)->paginate(12);
            }

            if (isset($year) xor isset($year_all)) {
                if ($year == null) {
                    $year = $year_all;
                }
                $result = Film::whereIn('year', $year)->paginate(12);
            }
            
            
        }
        
       

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
        }
        
            foreach ($result as $key => $value){
                $id = $value->id;
                $acategory = DB::table('films_categories')->where('film_id',$id)->leftJoin('categories', 'categories.id','=','films_categories.category_id')->get();
                $country = DB::table('films_countries')->where('film_id',$id)->leftJoin('countries', 'countries.id','=','films_countries.country_id')->get();
                 $value['countries'] = $country;
                 $value['categories'] = $acategory;
                
            }
            
          
        
        

        //  randomi laterner@ chi ashxatum
        
//        dd("filtercontroller");
                 
   

        return view('site.filter', ['result' => $result, 'count' => $count,'year' => $year, 'category' => $category,'list' => $list]);
    }

}
