<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Film;
use App\Category;
use App\Country;
use App\Comment;
use Illuminate\Support\Facades\Session;

class CommentController extends AppController
{
    public function index(Request $request){
		
	if (Session::has('role') & Session::has('name')) {
            $data = new Comment;
            $data->user_id = Session::get('role');
            $data->film_id = $request->id;
            $data->comment = $request->comment;
            $data->save();
            
                 
        }
         return redirect()->back();      
}

}