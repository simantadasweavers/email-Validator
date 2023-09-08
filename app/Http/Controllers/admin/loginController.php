<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins;

class loginController extends Controller
{
    function redirect(){
        if(session()->get('adminMail')){
            return redirect('/admindashboard');
        }
        else{
            return view('admin/login');
        }
    }

    function login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $adminname = $request['username'];
        $adminpass = $request['password'];

        $host = "localhost";
        $user = env('DB_USERNAME');
        $dbpass = env('DB_PASSWORD');
        $db = env('DB_DATABASE');
        $conn = mysqli_connect($host,$user,$dbpass,$db);

        // filter admin inputs
        $adminname = mysqli_real_escape_string($conn,$adminname);
        $adminpass = mysqli_real_escape_string($conn,$adminpass);
        $adminname = htmlspecialchars($adminname);
        $adminpass = htmlspecialchars($adminpass);

         $num = Admins::where('adminname','=',$adminname)
        ->where('adminpass','=',$adminpass)
        ->get()->count();

        if($num == 1){
            session(['adminMail' => $adminname]);

            return redirect('/admindashboard');
        }   
        else{
            return "ADMIN NOT FOUND!";
        } 

    }
}
