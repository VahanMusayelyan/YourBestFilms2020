<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\AppController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Film;
use App\User;
use App\FilmsCategory;
use Illuminate\Support\Facades\Session;

class MainController extends AppController
{
    public function index() {

        $result = Film::get()->toArray();
        $resultyear= Film::get()->sortBy('year')->toArray();
        $resultcategory = DB::table('films_categories')
            ->leftJoin('categories', 'films_categories.category_id', '=', 'categories.id')
            ->get()->sortBy('category_id')->toArray();
        
        foreach ($resultcategory as $key => $value){
            $arrCat[] = $value->category;
        }
        $valsCat = array_count_values($arrCat);
        
        
        foreach ($resultyear as $key => $value){
            $arrYear[] = $value['year'];
        }
        $valsYear = array_count_values($arrYear);
        
        $resultuser = DB::table('users')->get()->toArray();
        $countUser = count($resultuser);
        return view('dashboard.index',['valsCat' => $valsCat,'valsYear' => $valsYear,'countUser' =>$countUser]);
    }
    
   
}
