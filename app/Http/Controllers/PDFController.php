<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Visitors;
use App\Models\Invalidemails;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];
          
        $visitormail = session()->get('visitormail');
    
        $clientID = Visitors::select('enrollno')->where('email','=',$visitormail)
        ->first()->enrollno;

        $mails = Invalidemails::where('clientid','=',$clientID)->orderBy('id','DESC')->get();
    
      $pdf = PDF::loadView('pdfs/invalid',['mail'=>$mails]);
    
     return $pdf->download('invalidmails.pdf');
    }
}
