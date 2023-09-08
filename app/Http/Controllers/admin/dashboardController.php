<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Validemails;
use App\Models\Invalidemails;
use App\Models\Allemails;
use App\Models\Visitors;

class dashboardController extends Controller
{
    function gateway(){
        if(session()->get('adminMail')){
            $all = Allemails::get()->count();
            $valid = Validemails::get()->count();
            $inavlid = Invalidemails::get()->count();
            $visitor = Visitors::get()->count();
            
            $mails = Allemails::all();
            
            return view('admin/dashboard',['mail'=>$mails,'all'=>$all,'valid'=>$valid,'invalid'=>$inavlid,'visitor'=>$visitor]);
        }
        else{
            return redirect('/admin');
        }
    }
}
