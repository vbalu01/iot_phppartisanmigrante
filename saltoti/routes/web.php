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

Route::get('/', function () {
    try {
        DB::connection()->getPdo();
        print_r("müxik");
    } catch (\Exception $e) {
        print_r("Could not connect to the database.  Please check your configuration. error:" . $e );
    }
    return view('welcome');
});
