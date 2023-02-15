<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\StateController;
use App\Http\Controllers\Api\CityController;

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
Route::post('country/add', [CountryController::class, 'store']);
Route::post('state/add', [StateController::class, 'store']);
Route::post('city/add', [CityController::class, 'store']);
Route::post('register', [UserController::class, 'register']);
Route::post('user/login', [UserController::class, 'login']);
Route::group(['middleware'=> ['auth:sanctum']], function (){
    Route::get('user/logout', [UserController::class, 'logout']);    
    Route::get('user-profile', [UserController::class, 'userProfile']);
    Route::get('users-list', [UserController::class, 'userslist']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


