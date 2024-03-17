<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TagController;
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
   // Route::get('/all_article',[ArticleController::class,"index"])->name('article.list');
   
    Route::get('/logout',[ClientController::class,"logout"])->name('logout');

    Route::get('/articles/datatable', [ArticleController::class, 'datatable'])->name('articles.datatable');
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/article/{id}', [ArticleController::class, 'show'])->name('article.show');
    Route::delete('/article/{id}', [ArticleController::class, 'destroy'])->name('article.delete');
    Route::post('/article', [ArticleController::class, 'store'])->name('article.store');

    //Route::get('/articles/{article}/edit',[ArticleController::class,'edit'])->name('article.edit');
    //Route::resource('article',ArticleController::class);

    Route::get('category',[CategoryController::class,'index'])->name('categories.index');
    Route::get('tag',[TagController::class,'index'])->name('tags.index');
});