<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
use App\Car;

use  Illuminate\Http\Request;
Route::get('/', 'HomeController@index');

//Route::get('/', function () {
   // $cars = Car::all();

   // return View::make('profile')->with('cars',$cars);
//});

//Route::resource('cars', 'CarController');
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/admin', 'AdminController@index');
Route::get('/role', 'RoleController@index');
Route::get('/role/register', 'RoleController@register');
Route::get('cars/{cars_id?}',function($cars_id){
    $car = Car::find($cars_id);

    return Response::json($car);
});

Route::post('cars',function(Request $request){
    $car = Car::create($request->all());

    return Response::json($request);
});

Route::put('cars/{cars_id?}',function(Request $request,$cars_id){
    $car = Car::find($cars_id);
    $task= Car::first();
    $task->model = $request->model;
    $task->produced_on = $request->produced_on;

    $task->save();

    return Response::json($task);
});

Route::delete('cars/{cars_id?}',function($cars_id){
    $car = Car::destroy($cars_id);

    return Response::json($car);
});


