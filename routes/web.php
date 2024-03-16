<?php

use App\Http\Controllers\ClientController;
use App\Models\Client;
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
})->name("login");

Route::post('/login', [ClientController::class,'authClient'])->middleware('client.checkinfo');

Route::get('/completeInfo', function () {
    return view('completeInfo');
})->name('completeInfo');

Route::post('/{client}/completeInfo', [ClientController::class,'update']);


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('client.checkinfo');
Route::group(['prefix'=> 'dashboard','middleware'=>['auth']],function(){

    Route::get('/',[ClientController::class,"index"])->name('dashboard');
    Route::get('/completeInfo', function () {
        return view('completeInfo');
    });
    Route::get('/logout',[ClientController::class,"logout"])->name('logout');
});