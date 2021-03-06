<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::namespace('API')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
   
    


    Route::middleware(['auth:api'])->group(function () {
        // User Update and related activity
           Route::post('storeInvoices', 'InvoiceController@storeInvoices');
           Route::get('getInvoices', 'InvoiceController@getInvoices');
           Route::get('count', 'InvoiceController@count');
           Route::get('logout', 'AuthController@logout');
           Route::get('sum_invoice', 'InvoiceController@sum_invoice');
          
    

        });       

    });