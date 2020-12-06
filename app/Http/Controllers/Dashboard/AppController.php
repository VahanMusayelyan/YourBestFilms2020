<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class AppController extends BaseController
{ 

    
     public function __construct(){
         
//           $this->middleware(function ($request,$next) {
//               
//           
//               
//                 if(!Auth::check()){
//          
//                     return redirect('/admin/auth');
//                      
//                 }
//                
//             return $next($request);             
//            });
     }
    
    
}
