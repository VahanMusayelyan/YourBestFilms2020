<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Film;
use App\Category;
use App\News;
use App\Country;
use Illuminate\Support\Facades\Session;

class NewsController extends AppController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
         $result = News::paginate(12);
         
         return view('site.news',['result' => $result]);
    }

  
}
