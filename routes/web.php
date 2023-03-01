<?php

use App\Http\Controllers\InsurenceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('insurence', [InsurenceController::class, 'index'])->name('insurence');

Route::middleware('insurenceKnown')->prefix('insurence/{name}')
->name('insurence.')->group(function() {
    Route::get('/', [InsurenceController::class, 'indexInsured'])->name('insured');
    Route::get('login', [InsurenceController::class, 'loginForm'])->name('login');
    Route::post('login', [InsurenceController::class, 'login'])->name('login');
    Route::get('appointment', [InsurenceController::class, 'appointmentPlaner'])
        ->middleware('insuredByInsurence')->name('appointmentPlaner');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
