<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('blank');
});


//Home route

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

//Categories routes
Route::resource('/admin/categories', 'Admin\CategoriesController')->middleware('auth');

//Question routes
Route::resource('/admin/questions', 'Admin\QuestionsController')->middleware('auth');

//usersManagement routes
Route::resource('/admin/users', 'Admin\ManageUsersController')->middleware('auth');

//Admin user routes
Route::get('/admin/user',[UserController::class,'edit'])->name('user.edit')->middleware('auth');
Route::put('/admin/user/update',[UserController::class,'update'])->name('user.update')->middleware('auth');

require __DIR__.'/auth.php';


