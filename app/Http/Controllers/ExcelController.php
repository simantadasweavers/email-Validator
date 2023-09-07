<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Exports\ExportUsers;
use App\Exports\ExportValidUsers;
use App\Exports\ExportAllEmails;

class ExcelController extends Controller
{
    public function exportUsersData(){
        if(session()->get('visitormail')){
            $fileName = 'invalid_users.xlsx';
        return Excel::download(new ExportUsers, $fileName);
        }else{
        return redirect('/');
        }
    }

    public function exportValidUsersData(){
        if(session()->get('visitormail')){
            $fileName = 'valid_users.xlsx';
        return Excel::download(new ExportValidUsers, $fileName);
        }else{
        return redirect('/');
        }
    }

    public function exportAllEmails(){
        if(session()->get('visitormail')){
            $fileName = 'all_emails.xlsx';
        return Excel::download(new ExportAllEmails, $fileName);
        }else{
        return redirect('/');
        }
    }
}
