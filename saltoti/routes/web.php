<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/',[App\Http\Controllers\MainController::class,'viewData']);
Route::get('/uzem/{id}/{pagemethod}',[App\Http\Controllers\MainController::class,'uzem']);
Route::get('/dash',[App\Http\Controllers\MainController::class,'getUsems']);
Route::get('/dash/uzem/{id}/{pagemethod}',[App\Http\Controllers\MainController::class,'uzem']);

Route::POST('/dash/kompresszor',[App\Http\Controllers\MainController::class,'getChart']);
Route::POST('/dash/elszivo',[App\Http\Controllers\MainController::class,'getChart']);
Route::POST('/dash/termelogep',[App\Http\Controllers\MainController::class,'getChart']);
