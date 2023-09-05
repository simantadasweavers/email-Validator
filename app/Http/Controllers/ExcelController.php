<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Exports\ExportUsers;

class ExcelController extends Controller
{
    public function exportUsersData(){
        $fileName = 'users.xlsx';
        return Excel::download(new ExportUsers, $fileName);
    }
}
