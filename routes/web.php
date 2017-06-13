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

Route::get('/', function () {
    $cars = Car::all();

    return View::make('profile')->with('cars',$cars);
});

//Route::resource('cars', 'CarController');
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('cars/{cars_id?}',function($cars_id){
    $car = Car::find($cars_id);

    return Response::json($car);
});

Route::post('cars',function(Request $request){
    $car = Car::create($request->all());

    return Response::json($car);
});

Route::put('cars/{cars_id?}',function(Request $request,$cars_id){
    $car = Car::find($cars_id);

    $task->model = $request->model;
    $task->produced_on = $request->produced_on;

    $task->save();

    return Response::json($task);
});

Route::delete('cars/{cars_id?}',function($cars_id){
    $car = Car::destroy($cars_id);

    return Response::json($car);
});
