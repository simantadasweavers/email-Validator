<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Allemails;
use App\Models\Visitors;
use App\Models\Validemails;
use App\Models\Invalidemails;
use DB;

use vendor\autoload;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;



class emailFilterController extends Controller
{
   public function filter(Request $request){

    if(session()->get('visitormail')){

        $visitormail = session()->get('visitormail');
    $enrollno = Visitors::select('enrollno')->where('email','=',$visitormail)
    ->first()->enrollno;

    if (!empty($_POST['email'])){

        $email = $_POST['email'];

        $validator = new EmailValidator();
        $multipleValidations = new MultipleValidationWithAnd([
            new RFCValidation(),
        new DNSCheckValidation()
    ]);
        //ietf.org has MX records signaling a server with email capabilities
    $res = $validator->isValid("$email", $multipleValidations); //true


    if($visitormail){

        $all = new Allemails;
        $all->clientid = $enrollno;
        $all->name = $email;
        $all->date = date("Y/m/d");
        date_default_timezone_set("Asia/Kolkata");
        $all->time = date("h:i:sa");
        $all->save();
    if($res){
        $valid = new Validemails;
        $valid->clientid = $enrollno;
        $valid->name = $email;
        $valid->date = date("Y/m/d");
        date_default_timezone_set("Asia/Kolkata");
        $valid->time = date("h:i:sa");
        $valid->save();
        echo "<b>".$email."</b>"."<font color='green'> VALID EMAIL </font> <br>";
    }
    else{
        $invalid = new Invalidemails;
        $invalid->clientid = $enrollno;
        $invalid->name = $email;
        $invalid->date = date("Y/m/d");
        date_default_timezone_set("Asia/Kolkata");
        $invalid->time = date("h:i:sa");
        $invalid->save();
        echo "<b>".$email."</b>"."<font color='red'> INVALID EMAIL </font> <br>";
    }
    }
    }

    }else{
    return redirect('/');
    }

   }

    // valid email section

   public function validemails(Request $request){
    if(session('visitormail')){
        $visitormail = session()->get('visitormail');
        $enrollno = Visitors::select('enrollno')->where('email','=',$visitormail)
            ->first()->enrollno;
       $data = DB::table('validemails')->where('clientid','=',$enrollno)->get();
        return view('valids',['mail'=>$data]);
    }else{
        return redirect('/');
    }
   }


   public function deletevalidAll(){
    if(session()->get('visitormail')){
        $visitormail = session()->get('visitormail');
        $enrollno = Visitors::select('enrollno')->where('email','=',$visitormail)->first()->enrollno;
        Validemails::where('clientid','=',$enrollno)->delete();
        $visitormail = session()->get('visitormail');
        $clientID = Visitors::select('enrollno')->where('email','=',$visitormail)
        ->first()->enrollno;
        $mails = Validemails::where('clientid','=',$clientID)->get();
        return view('valids',['mail'=>$mails]);
       
    }else{
    return redirect('/');
    }
   }

   public function deleteValid(Request $request){
    if(session()->get('visitormail')){
        $request->validate([ 'emailid' => 'required' ]);
        $emailid = $request['emailid'];
        $visitormail = session()->get('visitormail');
        $clientID = Visitors::select('enrollno')->where('email','=',$visitormail)
        ->first()->enrollno;
        $email = Validemails::where('id','=',$emailid)->where('clientid','=',$clientID)
        ->get();
        return view('delete/singleDeletevalid',['email'=>$email]);    
    }else{
    return redirect('/');
    }
    }

    public function deleteValidReq(Request $request){
        if(session()->get('visitormail')){
            $request->validate([ 'mailid' => 'required' ]);
            $id = $request['mailid'];
            $visitormail = session()->get('visitormail');
            $clientID = Visitors::select('enrollno')->where('email','=',$visitormail)
            ->first()->enrollno;
            Validemails::where('id','=',$id)->where('clientid','=',$clientID)->delete();
            $mails = Validemails::where('clientid','=',$clientID)->get();
            return view('valids',['mail'=>$mails]);
        
        }else{
        return redirect('/');
        }
     }


  // valid email section   

   public function invalids(){
    if(session()->get('visitormail')){

        $visitormail = session()->get('visitormail');
    $clientID = Visitors::select('enrollno')->where('email','=',$visitormail)
    ->first()->enrollno;
    $mails = Invalidemails::where('clientid','=',$clientID)->get();
    return view('invalids',['mail'=>$mails]);

    }else{
    return redirect('/');
    }
    
   }

   public function deleteInvalid(Request $request){
    if(session()->get('visitormail')){
        $request->validate([ 'emailid' => 'required' ]);
    $emailid = $request['emailid'];
    $visitormail = session()->get('visitormail');
    $clientID = Visitors::select('enrollno')->where('email','=',$visitormail)
    ->first()->enrollno;
    $email = Invalidemails::where('id','=',$emailid)->where('clientid','=',$clientID)
    ->get();
    return view('delete/singleDeleteInvalid',['email'=>$email]);
    }else{
    return redirect('/');
    }
    }

    public function deleteInvalidReq(Request $request){
        if(session()->get('visitormail')){
            $request->validate([ 'mailid' => 'required' ]);
    $id = $request['mailid'];
    $visitormail = session()->get('visitormail');
    $clientID = Visitors::select('enrollno')->where('email','=',$visitormail)
    ->first()->enrollno;
    Invalidemails::where('id','=',$id)->where('clientid','=',$clientID)->delete();
    $mails = Invalidemails::where('clientid','=',$clientID)->get();
    return view('invalids',['mail'=>$mails]);
        }else{
        return redirect('/');
        }
    }

    public function deleteInvalidAll(){
        if(session()->get('visitormail')){
            $visitormail = session()->get('visitormail');
        $clientID = Visitors::select('enrollno')->where('email','=',$visitormail)
        ->first()->enrollno;
        Invalidemails::where('clientid','=',$clientID)->delete();
        $mails = Invalidemails::where('clientid','=',$clientID)->get();
        return view('invalids',['mail'=>$mails]);
        }else{
        return redirect('/');
        }
    }

    public function deleteAllEmails(){
        if(session()->get('visitormail')){
            $visitormail = session()->get('visitormail');
            $clientID = Visitors::select('enrollno')->where('email','=',$visitormail)
            ->first()->enrollno;
            Allemails::where('clientid','=',$clientID)->delete();
            $visitormail = session()->get('visitormail');
            $clientID = Visitors::select('enrollno')->where('email','=',$visitormail)->first()->enrollno;
           $allemails = Allemails::where('clientid','=',$clientID)->orderBy('emailid', 'DESC')->get()->count();
           $validemails = Validemails::where('clientid','=',$clientID)->orderBy('id', 'DESC')->get()->count();
           $invaidemails = Invalidemails::where('clientid','=',$clientID)->orderBy('id', 'DESC')->get()->count();
            $all = Allemails::where('clientid','=',$clientID)->orderBy('emailid','DESC')->get();
            return view('dashboard',['all'=>$all,'allemail'=>$allemails,'valid'=>$validemails,'invalid'=>$invaidemails]);
     
        }else{
        return redirect('/');
        }
          }

  
}
