<?php

use App\Models\Status;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PaymentController;

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

Route::get('/', function() { return view('index', ['statuses' => Status::all()]); })->name('login');

Route::get('/user', [UserController::class, 'index'])               ->name('user.index')->middleware('auth');
Route::post('/user/store', [UserController::class, 'store'])        ->name('user.store');
Route::put('/user/{user}', [UserController::class, 'update'])       ->name('user.update');
Route::post('/user/login', [UserController::class, 'authenticate']) ->name('user.login');
Route::get('/user/logout', [UserController::class, 'logout'])       ->name('user.logout');


Route::put('/user/{user}/payment', [PaymentController::class, 'update'])       ->name('payment.update');
Route::get('/user/{payment}/payment', [PaymentController::class, 'download'])  ->name('payment.download');
Route::get('/admin/{payment}/{status}', [PaymentController::class, 'confirm']) ->name('payment.confirm');

Route::get('/user/article/{article}', [ArticleController::class, 'download'])  ->name('article.download');

Route::get('/admin', [AdminController::class, 'index'])           ->name('admin.index');
Route::get('/admin/admin', [AdminController::class, 'setAdmin'])  ->name('admin.setAdmin');