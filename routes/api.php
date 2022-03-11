<?php

use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\QuestionsController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//category routes
Route::apiResource('categories', 'Api\CategoriesController')->middleware('auth:sanctum');

//question routes
Route::get('questions/{id}',[QuestionsController::class,'index'])->middleware('auth:sanctum');
Route::post('questions/store',[QuestionsController::class,'store'])->middleware('auth:sanctum');
Route::post('question/edit/{id}',[QuestionsController::class,'update'])->middleware('auth:sanctum');
Route::delete('question/delete/{id}',[QuestionsController::class,'destroy'])->middleware('auth:sanctum');
Route::get('time_left',[UserController::class,'index'])->middleware('auth:sanctum');

Route::post('auth/tokens', [AccessTokensController::class, 'store']);
Route::delete('auth/tokens', [AccessTokensController::class, 'destroy'])
    ->middleware('auth:sanctum');
Route::post('forgot/password', [ForgotPasswordController::class,'forgot']);


