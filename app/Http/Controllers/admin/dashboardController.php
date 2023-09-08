<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    function gateway(){
        if(session()->get('adminMail')){
            
            return view('admin/dashboard');
        }
        else{
            return redirect('/admin');
        }
    }
}
