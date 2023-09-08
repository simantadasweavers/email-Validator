<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registrationController;
use App\Http\Controllers\emailFilterController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ExcelController;

// admin routes
use App\Http\Controllers\admin\loginController;
use App\Http\Controllers\admin\dashboardController;


Route::get('/', function () {
    if(session('visitormail')){
        return redirect('/dashboard');
    }else{
        return view('login');
    }
});
Route::get('/dashboard',[registrationController::class,'dashboard']);
Route::post('/registration',[registrationController::class,'save']);
Route::post('/login',[registrationController::class,'login']);
Route::get('/user_logout',[registrationController::class,'logout']);

Route::get('/filter',function(){
    if(session('visitormail')){
        return view('filter');
    }else{
        return redirect('/');
    }
});

Route::post('/emailvalidate',[emailFilterController::class,'filter'])->name('checkemail');


Route::get('/allmailspdf',[PDFController::class,'allEmailsGeneratePDF']);
Route::get('/allmailsxlsx',[ExcelController::class,'exportAllEmails']);
Route::get('/deleteAllEmails',[emailFilterController::class,'deleteAllEmails']);

Route::get('/validemails',[emailFilterController::class,'validemails']);
Route::get('/deletevalidEmailAll',[emailFilterController::class,'deletevalidAll']);
Route::get('/validmailspdf',[PDFController::class,'validmailsGeneratePDF']);
Route::post('/deletevalidEmail',[emailFilterController::class,'deleteValid']);
Route::post('/deletevalidEmail_req',[emailFilterController::class,'deleteValidReq']);
Route::get('/validmailsxls',[ExcelController::class,'exportValidUsersData']);

Route::get('/invalids',[emailFilterController::class,'invalids']);
Route::get('/invalidmailspdf',[PDFController::class,'generatePDF']);
Route::get('/invalidmailsxls',[ExcelController::class,'exportUsersData']);
Route::post('/deleteInvalidEmail',[emailFilterController::class,'deleteInvalid']);
Route::post('/deleteInvalidEmail_req',[emailFilterController::class,'deleteInvalidReq']);
Route::get('/deleteInvalidEmailAll',[emailFilterController::class,'deleteInvalidAll']);


// admin routes
Route::get('/admin',[loginController::class,'redirect']);
Route::post('/admin_login',[loginController::class,'login']);
Route::get('/admindashboard',[dashboardController::class,'gateway']);
