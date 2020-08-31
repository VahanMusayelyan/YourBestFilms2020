<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\AppController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Film;
use App\User;
use App\News;
use App\FilmsCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class NewsController extends AppController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $result = News::paginate(12);

        return view('dashboard.news.list', ['result' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('dashboard.news.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = new News;

        $image = $request->file('file')->store('upload/news', 'public');

        $data->header = $request['header'];
        $data->text = $request['text'];
        $data->img = $image;
        $data->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $result = News::find($id);

        return view('dashboard.news.edit', ['result' => $result]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
        $data = News::find($id);
       
        if ($request->file('file')) {
            $path = $data->img;
            Storage::delete('public/news/' . $path . '');
            $image = $request->file('file')->store('upload/news', 'public');
            $data->img = $image;
        }

        $data->header = $request->header;
        $data->text = $request->text;
        $data->save();

        return redirect('admin/news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $data = News::find($id);
        $path = $data['img'];
        Storage::delete('public/' . $path . '');
        $data->delete();

        return redirect('admin/news');
    }

}
