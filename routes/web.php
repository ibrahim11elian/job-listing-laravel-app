<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Mail\JobPosted;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


Route::view('/','home');
Route::view('/about','about');
Route::view('/contact','contact');

/*
* Job Routes
*/
Route::controller(JobController::class)->group(function(){
    // index
    Route::get('jobs','index');
    Route::get('user/jobs','userJobs')->middleware('auth');

    // store job
    Route::post('jobs','store')->middleware('auth');
    // create job view
    Route::get('/jobs/create','create')->middleware('auth');

    // get job
    Route::get('jobs/{job}','show');

    // edit job
    Route::get('jobs/{job}/edit','edit')->middleware('auth')->can('edit','job');

    // update job
    Route::patch('jobs/{job}','update')->middleware('auth')->can('edit','job');

    // delete job
    Route::delete('jobs/{job}','destroy')->middleware('auth')->can('edit','job');

});

// work exactly like the above code ^o^
// Route::resource('jobs', JobController::class)->only(['index','show']);
// Route::resource('jobs', JobController::class)->except(['index','show'])->middleware('auth');

// Route::resource('jobs', JobController::class,[
//     'only' => ['index','store','show','edit','update','destroy'], // use this if i want to use some of the methods
//     'except' => ['index','store','show','edit','update','destroy'] // use this if i want to not use some of the methods
// ]);

// Auth
Route::get('/register',[RegisteredUserController::class,'create']);
Route::post('/register',[RegisteredUserController::class,'store']);
Route::get('/login',[SessionController::class,'create'])->name('login');
Route::post('/login',[SessionController::class,'store'])->middleware('throttle:login');
Route::post('/logout',[SessionController::class,'destroy']);
