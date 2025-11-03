<?php

use App\Http\Controllers\Admin\WorkSummaryController;
use App\Http\Controllers\FaultsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterController;



Route::get('/', function () {
    return view('main.home');
})->name('/');

Route::get('/about', function () {
    return view('main.about');
})->name('about');

Route::get('/contact-us', function () {
    return view('main.contact-us');
})->name('contact-us');


// Auth
Route::get('register', [RegisterController::class, 'create'])->name('register.create');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');

Route::post('logout', [SessionController::class, 'destroy'])->name('logout');

Route::get('login', [SessionController::class, 'create'])->name('login');
Route::post('login', [SessionController::class, 'store'])->name('login.store');


Route::middleware('auth')->group(function () {

    //Profile
    Route::resource('user', ProfileController::class);

    //Fault
    Route::resource('faults', FaultsController::class);

    //Work Summary
    Route::get('work-summary', [WorkSummaryController::class, 'index'])->name('work-summary.index');


    //Admin Work Summary
    Route::middleware('admin')->group(function () {
        Route::get('work-summary/create', [WorkSummaryController::class, 'create'])->name('work-summary.create');
        Route::post('work-summary', [WorkSummaryController::class, 'store'])->name('work-summary.store');
    });
});
