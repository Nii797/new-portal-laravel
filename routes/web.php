<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/Admin', function () {
    return view('login');
});

// Route::get('/', function () {
//     return view('front');
// });

// front end
Route::get('/','Web\FrontController@index')->name('home-artikel');
Route::get('/about','Web\FrontController@about')->name('about');
Route::get('/contact','Web\FrontController@contact')->name('contact');
Route::get('/Artikel/{artikel}','Web\FrontController@show')->name('artikel.detail');
Route::get('/Artikel-kategori/{kategori}','Web\FrontController@artikel_ketegori')->name('artikel.kategori');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

// back end
Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('categori','CategoriController');
    Route::resource('artikel','ArtikelController');
});
