<?php

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

Route::get('/', function () {
    return view('home');
  //  $savedroutes = DB::table('shareroutes')->get();
  //  return view('home', compact('savedroutes'));
});
Route::get('/home', function () {
    return view('home');
  //  $savedroutes = DB::table('shareroutes')->get(); //Hämtar alla poster i db shareroutes
  //  return view('home', compact('savedroutes')); //Retur till view home, variabledata skickas med.
});


Route::get('/about', function () {
    return view('about');
});
Route::get('/cities', function () {
    return view('cities');
});
Route::get('/recommended', function () {
    return view('recommended');
});
Route::get('/scheduele', function () {
    return view('scheduele');
});
Route::get('/city', function () {
    return view('city');
});

Route::get('/create', 'TaskController@index'); //Om sidan create används, gå till TaskController@index
Route::post('/share', 'TaskController@store');
Route::get('/share/{task}', 'TaskController@show');
