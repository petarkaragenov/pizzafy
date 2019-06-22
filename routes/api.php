<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/pizzas', 'PizzasController@index');
Route::get('/pizzas/{pizza}/edit', 'PizzasController@edit');
Route::post('/pizzas/store', 'PizzasController@store');
Route::patch('/pizzas/{pizza}', 'PizzasController@update');
Route::delete('/pizzas/{pizza}', 'PizzasController@destroy');
Route::get('pizzas/sort', 'PizzasController@sort');
Route::get('pizzas/search', 'PizzasController@search');

Route::patch('profile/', 'UsersController@update');

Route::post('/charge', 'PaymentsController@charge');

Route::get('/orders', 'OrdersController@index');
Route::get('/orders/{order}', 'OrdersController@show');
Route::get('/orders/{order}/items', 'OrdersController@show_items');
Route::get('/orders/{order}/customer', 'OrdersController@show_customer');
Route::patch('/orders/{order}', 'OrdersController@update');
Route::get('/orders/user/{user}', 'OrdersController@user_orders');


