<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registrationController;
use App\Http\Controllers\emailFilterController;

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
