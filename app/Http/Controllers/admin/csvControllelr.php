<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Allemails;

class csvControllelr extends Controller
{
    function generateCSV(){
    
        $fileName = 'allemails.csv';
        $mails = Allemails::all();
     
             $headers = array(
                 "Content-type"        => "text/csv",
                 "Content-Disposition" => "attachment; filename=$fileName",
                 "Pragma"              => "no-cache",
                 "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                 "Expires"             => "0"
             );
     
             $columns = array('Enroll No','Email','Date');
     
             $callback = function() use($mails, $columns) {
                 $file = fopen('php://output', 'w');
                 fputcsv($file, $columns);
     
                 foreach ($mails as $mail) {
                    $row['emailid']  = $mail->emailid;
                     $row['name']  = $mail->name;
                     $row['date']  = $mail->date;
     
                     fputcsv($file,array($row['emailid'],$row['name'],$row['date']));
                 }
     
                 fclose($file);
             };
     
             return response()->stream($callback, 200, $headers);

    }
}
