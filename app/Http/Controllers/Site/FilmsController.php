<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Film;
use App\Category;
use App\Country;
use Illuminate\Support\Facades\Session;

class FilmsController extends AppController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $like = "";
        $dislike = "";
        $result = Film::orderBy('id', 'desc')->paginate(12);
        $count = count(Film::all());
        $list = 1;

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
        

        return view('site.welcome', ['result' => $result, 'count' => $count,'list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $status_film = [];
        $watched_film = [];
        $later_film = [];
        $comment = [];
        
        if (Session::has('role')) {
            $user_id = Session::get('role');
            $status_film = DB::table('liked_disliked_films')->where([
                        ['user_id', '=', $user_id],
                        ['film_id', '=', $id]
                    ])->get()->toArray();
            $watched_film = DB::table('watched_films')->where([
                        ['user_id', '=', $user_id],
                        ['film_id', '=', $id]
                    ])->get()->toArray();
            $later_film = DB::table('later_films')->where([
                        ['user_id', '=', $user_id],
                        ['film_id', '=', $id]
                    ])->get()->toArray();
        }
        

        $comment = DB::table('comments')->where('film_id', $id)
                ->leftJoin('users', 'comments.user_id','=','users.id')
                ->paginate(12);
        
        $result = DB::table('films')->where('id', $id)->get();
        $category = DB::table('films_categories')
                        ->where('film_id', $id)
                        ->leftJoin('categories', 'films_categories.category_id', '=', 'categories.id')
                        ->get()->toArray();

        $countries = DB::table('films_countries')
                        ->where('film_id', $id)
                        ->leftJoin('countries', 'films_countries.country_id', '=', 'countries.id')
                        ->get()->toArray();

        return view('site.film', ['result' => $result,
            'category' => $category,
            'countries' => $countries,
            'status_film' => $status_film,
            'watched_film' => $watched_film,
            'comment' => $comment,
            'later_film' => $later_film
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function random() {
        $status_film = [];
        $watched_film = [];
        $later_film = [];

        $max = DB::table('films')->max('id');
        $min = DB::table('films')->min('id');

        do {
            $rand = rand($min, $max);
            $result = DB::table('films')->where('id', $rand)->get();
            $row = count($result);
        } while ($row == 0);

        if (Session::has('role')) {
            $user_id = Session::get('role');
            $status_film = DB::table('liked_disliked_films')->where([
                        ['user_id', '=', $user_id],
                        ['film_id', '=', $rand]
                    ])->get()->toArray();
            $watched_film = DB::table('watched_films')->where([
                        ['user_id', '=', $user_id],
                        ['film_id', '=', $rand]
                    ])->get()->toArray();
            $later_film = DB::table('later_films')->where([
                        ['user_id', '=', $user_id],
                        ['film_id', '=', $rand]
                    ])->get()->toArray();
        }

        $category = DB::table('films_categories')
                        ->where('film_id', $rand)
                        ->leftJoin('categories', 'films_categories.category_id', '=', 'categories.id')
                        ->get()->toArray();

        $countries = DB::table('films_countries')
                        ->where('film_id', $rand)
                        ->leftJoin('countries', 'films_countries.country_id', '=', 'countries.id')
                        ->get()->toArray();


        return view('site.random', ['result' => $result,
            'category' => $category,
            'countries' => $countries,
            'status_film' => $status_film,
            'watched_film' => $watched_film,
            'later_film' => $later_film]);
    }

    public function newfilms() {
        $like = "";
        $dislike = "";
        $result = Film::orderBy('year', 'desc')->paginate(12);;
        $count = count(Film::all());
        $list = 1;

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
        

        return view('site.new', ['result' => $result, 'count' => $count,'list' => $list]);        

    }
    
    public function topfilms() {
        
        $like = "";
        $dislike = "";
        $result = Film::orderBy('ratingImdb', 'desc')->paginate(12);;
        $count = count(Film::all());
        $list = 1;

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
        

        return view('site.top', ['result' => $result, 'count' => $count,'list' => $list]); 
        
    }

}
