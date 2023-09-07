<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Visitors;
use App\Models\Invalidemails;
use App\Models\Validemails;
use App\Models\Allemails;

class PDFController extends Controller
{
    public function generatePDF()
    {
        if(session()->get('visitormail')){
            $data = [
                'title' => 'Welcome to microcodes.in',
                'date' => date('m/d/Y')
            ];
            $visitormail = session()->get('visitormail');
            $clientID = Visitors::select('enrollno')->where('email','=',$visitormail)
            ->first()->enrollno;
            $mails = Invalidemails::where('clientid','=',$clientID)->get();
          $pdf = PDF::loadView('pdfs/invalid',['mail'=>$mails]);
         return $pdf->download('invalidmails.pdf');
        }else{
        return redirect('/');
        }
    }

    public function validmailsGeneratePDF(){
        if(session()->get('visitormail')){
            $data = [
                'title' => 'Welcome to microcodes.in',
                'date' => date('m/d/Y')
            ];
            $visitormail = session()->get('visitormail');
            $clientID = Visitors::select('enrollno')->where('email','=',$visitormail)
            ->first()->enrollno;
            $mails = Validemails::where('clientid','=',$clientID)->get();
          $pdf = PDF::loadView('pdfs/valid',['mail'=>$mails]);
         return $pdf->download('validmails.pdf');
        }else{
        return redirect('/');
        }
    }

    public function allEmailsGeneratePDF(){
        if(session()->get('visitormail')){
            $data = [
                'title' => 'Welcome to microcodes.in',
                'date' => date('m/d/Y')
            ];
            $visitormail = session()->get('visitormail');
            $clientID = Visitors::select('enrollno')->where('email','=',$visitormail)
            ->first()->enrollno;
            $mails = Allemails::where('clientid','=',$clientID)->get();
            $pdf = PDF::loadView('pdfs/allmails',['mail'=>$mails]);
             return $pdf->download('allmails.pdf');
        }else{
        return redirect('/');
        }
    }

}
