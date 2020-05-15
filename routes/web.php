<?php

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

Route::get('/', function () {
    return view('layouts.home');
});

Route::get('/simulation', array('uses'=>'SimulationController@show'));

Route::get('/dashboard',array('uses'=>'ModuleRegistrationController@showModules'));

Route::get('/create', function () {
    return view('create');
});



Route::post('/create',array('uses'=>'ModuleRegistrationController@moduleRegister'));
