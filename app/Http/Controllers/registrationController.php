<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitors;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Allemails;
use App\Models\Validemails;
use App\Models\Invalidemails;

class registrationController extends Controller
{
   public function save(Request $request){

    $request->validate([
        'name'=>'required',
        'phone'=>'required',
        'email'=>'required|email',
        'pass1'=>'required',
        'pass2'=>'required'
    ]);

    $name = $request['name'];
    $phone = $request['phone'];
    $email = $request['email'];
    $pass1 = $request['pass1'];
    $pass2 = $request['pass2'];

    // connecting to mysql db
    $host="localhost";
    $user=env('DB_USERNAME');
    $pass=env('DB_PASSWORD');
    $db=env('DB_DATABASE');
    $conn = mysqli_connect($host,$user,$pass,$db);

     // filtering user inputs
    $name = htmlspecialchars($name);
    $phone = htmlspecialchars($phone);
    $email = htmlspecialchars($email);
    $pass1 = htmlspecialchars($pass1);
    $pass2 = htmlspecialchars($pass2);
    // filtering for SQL injection
    $name = mysqli_real_escape_string($conn,$name);
    $phone = mysqli_real_escape_string($conn,$phone);
    $email = mysqli_real_escape_string($conn,$email);
    $pass1 = mysqli_real_escape_string($conn,$pass1);
    $pass2 = mysqli_real_escape_string($conn,$pass2);

    if($pass1 == $pass2){
        $visitor = new Visitors;

        // saving record
        $visitor->name = $name;
        $visitor->phone = $phone;
        $visitor->email = $email;
        $visitor->passwd =  Hash::make($pass1);
        $visitor->date = date("Y/m/d");
        date_default_timezone_set("Asia/Kolkata");
        $visitor->time = date("h:i:sa");
        $visitor->loc = $_SERVER['REMOTE_ADDR'];
        $visitor->save();

        session(['visitormail' => $email]);

        return redirect('/dashboard');
    }
    else{
        return "Your Both Passwords Not Matched!";
    }
   }

   public function login(Request $request){
    // echo "<pre>";
    // print_r($request->all());
    $request->validate([
        'uemail'=>'required',
        'upass'=>'required'
    ]);

    $email = $request['uemail'];
    $pass = $request['upass'];

    // connecting to mysql db
    $host="localhost";
    $user=env('DB_USERNAME');
    $dbpass=env('DB_PASSWORD');
    $db=env('DB_DATABASE');
    $conn = mysqli_connect($host,$user,$dbpass,$db);

    // filtering user inputs
    $email = htmlspecialchars($email);
    $email = mysqli_real_escape_string($conn,$email);
    $pass = htmlspecialchars($pass);
    $pass = mysqli_real_escape_string($conn,$pass);


    $hashedPassword = Visitors::select('passwd')->where('email','=',$email)
    ->first()->passwd;

    if (Hash::check($pass, $hashedPassword))
    {
        session(['visitormail' => $email]);
        return redirect('/dashboard');
    }
    else{
        return redirect('/');
    }
   }

   public function logout(){
    if(session('visitormail')){
        session()->forget('visitormail');
        session()->flush();

        return redirect('/');
    }else{
        return view('login');
    }
   }

   public function dashboard(){
    if(session('visitormail')){
        $visitormail = session()->get('visitormail');
        $clientID = Visitors::select('enrollno')->where('email','=',$visitormail)->first()->enrollno;
        
       $allemails = Allemails::where('clientid','=',$clientID)->get()->count();
       $validemails = Validemails::where('clientid','=',$clientID)->get()->count();
       $invaidemails = Invalidemails::where('clientid','=',$clientID)->get()->count();
    
       $all = Allemails::where('clientid','=',$clientID)->get();

       return view('dashboard',['all'=>$all,'allemail'=>$allemails,'valid'=>$validemails,'invalid'=>$invaidemails]);
    }else{
        return view('login');
    }
   }

}
