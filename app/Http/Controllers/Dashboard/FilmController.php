<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;
use App\Film;
use App\Category;
use App\Country;

class FilmController extends AppController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $result = Film::paginate(10);

     
        return view('dashboard.film.list', ['result' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $category = DB::table('categories')->get()->toArray();
        $country = DB::table('countries')->get()->toArray();
        return view('dashboard.film.form', ['country' => $country, 'category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $validatedData = $request->validate([
            'nameEng' => ['required'],
            'nameRus' => ['required'],
            'year' => ['required', 'numeric', 'digits:4'],
            'ratingImdb' => ['required'],
            'ratingKinopoisk' => ['required'],
            'videourl' => ['required'],
            'duration' => ['required', 'numeric'],
            'description' => ['required'],
            'file' => ['file', 'mimes:jpeg,jpg,png', 'required'],
        ]);

        $data = new Film;

        $image = $request->file('file')->store('upload/films', 'public');

        $data->nameEng = $request['nameEng'];
        $data->nameRus = $request['nameRus'];
        $data->year = $request['year'];
        $data->ratingImdb = $request['ratingImdb'];
        $data->ratingKinopoisk = $request['ratingKinopoisk'];
        $data->videourl = $request['videourl'];
        $data->duration = $request['duration'];
        $data->description = $request['description'];
        $data->img = $image;
        $data->save();

        $id = $data->id;

        $category = $request['category'];
        $country = $request['country'];

        foreach ($category as $key => $value) {
            DB::table('films_categories')->insert(
                    ['film_id' => $id, 'category_id' => $value]);
        }

        foreach ($country as $key => $value) {
            DB::table('films_countries')->insert(
                    ['film_id' => $id, 'country_id' => $value]);
        }



        return redirect()->route('film.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
        $result = Film::find($id);
          
        return view('dashboard.film.details', ['result' => $result]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $result = Film::find($id);
        $rescategory = DB::table('categories')->get()->toArray();
        $rescountry = DB::table('countries')->get()->toArray();
        $country = DB::table('films_countries')->get()->where('film_id', $id)->toArray();
        $category = DB::table('films_categories')->get()->where('film_id', $id)->toArray();

        foreach ($result->categories as $value){
          $id = $value->id;
          $filmcategory[$id] = $value;
        }
        foreach ($rescategory as $valueCat){
            
            $catArray[$valueCat->id] = $valueCat;
        }
        
        foreach ($result->countries as $value){
          $id = $value->id;
          $filmcountry[$id] = $value;
        }
        foreach ($rescountry as $valueCount){
            
            $countArray[$valueCount->id] = $valueCount;
        }

        return view('dashboard.film.edit', ['result' => $result, 'catArray' => $catArray, 'countArray' => $countArray,'filmcategory' => $filmcategory,'filmcountry' => $filmcountry]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'nameEng' => ['required'],
            'nameRus' => ['required'],
            'year' => ['required', 'numeric', 'digits:4'],
            'ratingImdb' => ['required'],
            'ratingKinopoisk' => ['required'],
            'videourl' => ['required'],
            'duration' => ['required', 'numeric'],
            'description' => ['required'],
            'file' => ['file', 'mimes:jpeg,jpg,png'],
        ]);
        
        
        $data = Film::find($id);

        if ($request->file('file')) {
            $path = $data['img'];
            Storage::delete('public/' . $path . '');
            $image = $request->file('file')->store('upload/films', 'public');
            $data->img = $image;
        }

        $data->nameEng = $request['nameEng'];
        $data->nameRus = $request['nameRus'];
        $data->year = $request['year'];
        $data->ratingImdb = $request['ratingImdb'];
        $data->ratingKinopoisk = $request['ratingKinopoisk'];
        $data->videourl = $request['videourl'];
        $data->duration = $request['duration'];
        $data->description = $request['description'];
        $data->save();

        $id = $data->id;

        
        DB::table('films_categories')->where('film_id', $id)->delete();
        DB::table('films_countries')->where('film_id', $id)->delete();
        
        
        $category = $request['category'];
        $country = $request['country'];

        foreach ($category as $key => $value) {
            DB::table('films_categories')->insert(
                    ['film_id' => $id, 'category_id' => $value]);
        }

        foreach ($country as $key => $value) {
            DB::table('films_countries')->insert(
                    ['film_id' => $id, 'country_id' => $value]);
        }



        return redirect('admin/film');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $data = Film::find($id);
        $dataCat = DB::table('films_categories')->where('film_id', '=', $id);
        $dataCount = DB::table('films_countries')->where('film_id', '=', $id);
        $path = $data['img'];
        Storage::delete('public/' . $path . '');
        $data->delete();
        $dataCat->delete();
        $dataCount->delete();
        return redirect('admin/film');
    }
    
    public function filter($filter = null,$type = null) {
        $data = new Film;
        if(!is_null($filter)) {
            $result = Film::select()->orderBy('nameEng', $type)->paginate(10);               
        }
        return view('dashboard.film.list', ['result' => $result]);
    }

}
