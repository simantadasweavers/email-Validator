<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Models\Allemails;

class pdfControllelr extends Controller
{
    function generatePDF(){
        // $data = [
        //     'title' => 'Welcome to microcodes.in',
        //     'date' => date('m/d/Y')
        // ];

        $data = Allemails::all();
          
        $pdf = PDF::loadView('admin/allemails',['data'=>$data]);
    
        return $pdf->download('all_mails.pdf');
    }
}
