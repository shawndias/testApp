<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Models\Customers;


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
     $customerData = Customers::all();
     $currentDate = date("Y-m-d");
    return view('welcome',compact('customerData','currentDate'));
});

//customer Routes
Route::post('customer/insert',[CustomerController::class, 'store']);
Route::get('customer/delete/{id}',[CustomerController::class, 'delete']);

