<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registrationController;
use App\Http\Controllers\emailFilterController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ExcelController;

Route::get('/', function () {
    if(session('visitormail')){
        return view('dashboard');
    }else{
        return view('login');
    }
});
Route::get('/dashboard',function(){
    if(session('visitormail')){
        return view('dashboard');
    }else{
        return redirect('/');
    }
});
Route::post('/registration',[registrationController::class,'save']);
Route::post('/login',[registrationController::class,'login']);

Route::get('/filter',function(){
    if(session('visitormail')){
        return view('filter');
    }else{
        return redirect('/');
    }
});

Route::post('/emailvalidate',[emailFilterController::class,'filter'])->name('checkemail');

Route::get('/validemails',[emailFilterController::class,'validemails']);
Route::get('/deletevalidEmailAll',[emailFilterController::class,'deletevalidAll']);
Route::get('/validmailspdf',[PDFController::class,'validmailsGeneratePDF']);

Route::get('/invalids',[emailFilterController::class,'invalids']);
Route::get('/invalidmailspdf',[PDFController::class,'generatePDF']);
Route::get('/invalidmailsxls',[ExcelController::class,'exportUsersData']);
Route::post('/deleteInvalidEmail',[emailFilterController::class,'deleteInvalid']);
Route::post('/deleteInvalidEmail_req',[emailFilterController::class,'deleteInvalidReq']);
Route::get('/deleteInvalidEmailAll',[emailFilterController::class,'deleteInvalidAll']);

