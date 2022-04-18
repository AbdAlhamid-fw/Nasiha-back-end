<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HousesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Models\Houses;

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
// TODO : public and portected
// ****************public routes*******************************
// auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Houses
Route::get('houses', [HousesController::class, 'index']);
Route::get('houses/{id}', [HousesController::class, 'show']);





// *******************protected routes***************************
Route::group(['middleware' => ['auth:sanctum']],function (){

    // Houses
    Route::get('user-houses', [HousesController::class, 'userHouses']);
    Route::post('houses/create', [HousesController::class, 'store']);
    Route::put('houses/update/{id}', [HousesController::class, 'update']);
    Route::delete('houses/delete/{id}', [HousesController::class, 'destroy']);

    // auth
    Route::post('/logout', [AuthController::class, 'logout']);

    //users
    Route::get('users/', [UserController::class, 'index']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::post('users/create', [UserController::class, 'store']);
    Route::put('users/update/{id}', [UserController::class, 'update']);
    Route::delete('users/delete/{id}', [UserController::class, 'destroy']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
