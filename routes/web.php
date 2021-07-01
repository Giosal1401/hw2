<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/prodotti', 'HomeController@jsonProdotti');

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@checkLogin');
Route::get('/logout', 'LoginController@logout')->name('logout');

Route::get('/register', 'RegisterController@index')->name('register');
Route::post('register','RegisterController@createUser');
Route::get('/register/username/{q}', 'RegisterController@checkUsername');
Route::get('/register/email/{q}', 'RegisterController@checkEmail');
Route::post('register','RegisterController@createUser');

Route::get('/account', 'AccountController@index')->name('account');
Route::get('/account/auth', 'AccountController@auth');
Route::get('/account/prodotti/preferiti', 'AccountController@jsonProdottiPreferiti');
Route::get('/account/preferiti/{action}/{q}', 'AccountController@add_remove_preferiti');   
Route::get('/account/prodotti/carrello', 'AccountController@jsonProdottiCarrello');
Route::get('/account/ordini', 'AccountController@jsonOrdini');   
Route::post('/account/change/{q}', 'AccountController@changeDetails');

 
Route::get('/carrello', 'CarrelloController@index')->name('carrello');
Route::get('/carrello/prodotti', 'CarrelloController@numeroProdottiCarrello'); 
Route::post('/carrello/buy', 'CarrelloController@addToCart');
Route::get('/carrello/buy/checkout', 'CarrelloController@checkoutCart'); 

Route::get('/music','MusicController@index')->name('music');
Route::get('/music/search/{q}','MusicController@searchMusic');

Route::get('/sport','SportController@index')->name('sport');
Route::get('/sport/groups','SportController@jsonGroups');
Route::get('/sport/group/id/{q}','SportController@searchGroupById');
Route::get('/sport/search/{q}','SportController@searchSportByName');
Route::get('/sport/id/{q}','SportController@searchSportById');


Route::get('/novita','NovitaController@index')->name('novita');
Route::get('/novita/prodotti','NovitaController@prodottiMaxVendite2');
Route::post('/novita/ricerca/prodotti','NovitaController@ricercaProdotti');