<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\AppController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\User;

class ExitController extends AppController {

    public function index(Request $request) {
        
        dd($request);
        
        return view('dashboard.auth.login');
    }


}
