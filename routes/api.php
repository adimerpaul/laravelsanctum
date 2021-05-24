<?php

//use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
//use App\Http\Controllers\ProductoController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/producto',[\App\Http\Controllers\ProductoController::class,'index']);

Route::group(['middleware'=>'auth:sanctum'],function (){
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout',[AuthController::class,'logout']);
    Route::apiResource('/producto',ProductoController::class,['except'=>['index','show']]);
//    Route::apiResource('/producto',ProductoController::class);
//    Route::apiResource('productos', \App\Http\Controllers\ProductoController::class, ['except' => ['index']]); //CRUD tabla pruductos

});
