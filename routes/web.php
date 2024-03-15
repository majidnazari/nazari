<?php

use App\Http\Controllers\ClientController;
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



Route::get('/login', function () {
    return view('login');
})->name("client.wrong");

Route::post('/checklogin', [ClientController::class,'index'])->middleware('client.checkinfo');

Route::get('/completeInfo', function () {
    return view('completeInfo');
});

Route::post('/{client}/completeInfo', [ClientController::class,'update']);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('client.checkinfo');;