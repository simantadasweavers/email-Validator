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
        $fileName = 'invalid_users.xlsx';
        return Excel::download(new ExportUsers, $fileName);
    }

    public function exportValidUsersData(){
        $fileName = 'valid_users.xlsx';
        return Excel::download(new ExportValidUsers, $fileName);
    }

    public function exportAllEmails(){
        $fileName = 'all_emails.xlsx';
        return Excel::download(new ExportAllEmails, $fileName);
    }
}
