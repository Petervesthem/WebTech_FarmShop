<?php

use App\Http\Controllers\API\RESTController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('users',RESTController::class);

Route::middleware(['adminAuth'])->group(function (){
    Route::get('/', [RESTController::class,'findAllUsers']);
    Route::get('/{id}',[RESTController::class, 'showSpecificUser']);
    Route::post('/', [RESTController::class, 'storeUser']);

    Route::put('/{id}', [RESTController::class, 'updateUser']);
    Route::delete('/{id}', [RESTController::class, 'deleteUserByID']);

});
