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
   }

   public function validemails(Request $request){
    if(session('visitormail')){

        $visitormail = session()->get('visitormail');
        $enrollno = Visitors::select('enrollno')->where('email','=',$visitormail)
            ->first()->enrollno;

       $data = DB::table('validemails')->orderBy('id', 'DESC')->get();

        return view('valid',['data'=>$data]);

    }else{
        return redirect('/');
    }
   }

   public function invalids(){
    $visitormail = session()->get('visitormail');
    $clientID = Visitors::select('enrollno')->where('email','=',$visitormail)
    ->first()->enrollno;

    $mails = Invalidemails::where('clientid','=',$clientID)->orderBy('id','DESC')->get();
    
    return view('invalids',['mail'=>$mails]);
   }

   public function deleteInvalid(Request $request){
    //  echo "<pre>";
    //  print_r($request->all());
    $request->validate([ 'emailid' => 'required' ]);
    $emailid = $request['emailid'];
    $email = Invalidemails::where('id','=',$emailid)->get();
    return view('delete/singleDeleteInvalid',['email'=>$email]);
    }

    public function deleteInvalidReq(Request $request){
    //  echo "<pre>";
    //  print_r($request->all());
    $request->validate([ 'mailid' => 'required' ]);
    $id = $request['mailid'];
    Invalidemails::where('id','=',$id)->delete();
    

    $visitormail = session()->get('visitormail');
    $clientID = Visitors::select('enrollno')->where('email','=',$visitormail)
    ->first()->enrollno;
    $mails = Invalidemails::where('clientid','=',$clientID)->orderBy('id','DESC')->get();
    return view('invalids',['mail'=>$mails]);
    }

    public function deleteInvalidAll(){
        Invalidemails::truncate();
    
    $visitormail = session()->get('visitormail');
    $clientID = Visitors::select('enrollno')->where('email','=',$visitormail)
    ->first()->enrollno;
    $mails = Invalidemails::where('clientid','=',$clientID)->orderBy('id','DESC')->get();
    return view('invalids',['mail'=>$mails]);
    }

}
