<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\Auth;
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
//API route for register new user
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });
    //Api route for crud
    Route::resource('programs', App\Http\Controllers\API\ProgramController::class);
    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/products',[ProductApiController::class,'index']);
Route::get('/products/{id}',[ProductApiController::class,'show']);
Route::post('/products',[ProductApiController::class,'store']);
Route::get('/Auth/{id}',[Auth::class,'auth']);
Route::put('/products/{id}',[ProductApiController::class,'update']);
Route::delete('/products/{id}',[ProductApiController::class,'destroy']);
