<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;

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
Route::post('login',[LoginController::class,'login']);
Route::group(['middleware' => ['auth:sanctum']],function(){
    Route::post('refresh_access_token',[LoginController::class,'refreshAccessToken']);    
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     Route::post('refresh_access_token',LoginController::class,'refreshAccessToken');
// });
