<?php

use App\Models\Status;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AbstrakController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FullPaperController;

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

Route::get('/',             function() { return view('index', ['statuses' => Status::all()]); })  ->name('login');
Route::get('/registration', function() { return view('regist', ['statuses' => Status::all()]); }) ->name('regist');

Route::get('/abstract-fullpaper', [AbstrakController::class, 'index'])     ->name('abstract-fullpaper');
Route::post('/user/store',        [UserController::class, 'store'])        ->name('user.store');
Route::post('/user/login',        [UserController::class, 'authenticate']) ->name('user.login');

Route::middleware('auth')->group(function () {
    Route::get('/user',                           [UserController::class,      'index'])    ->name('user.index');
    Route::put('/user/update/{user}',             [UserController::class,      'update'])   ->name('user.update');
    Route::get('/user/logout',                    [UserController::class,      'logout'])   ->name('user.logout');
    Route::put('/user/payment/{user}',            [PaymentController::class,   'update'])   ->name('payment.update');
    Route::get('/user/payment/{payment}',         [PaymentController::class,   'download']) ->name('payment.download');
    Route::get('/user/payment/{payment}/{status}',[PaymentController::class,   'confirm'])  ->name('payment.confirm');
    Route::get('/user/article/{article}',         [ArticleController::class,   'download']) ->name('article.download');
    Route::get('/user/abstract/{abstrak}',        [AbstrakController::class,   'download']) ->name('abstrak.download');
    Route::get('/user/fullpaper/{fullpaper}',     [FullPaperController::class, 'download']) ->name('fullpaper.download');
    
    Route::get('/admin',                          [AdminController::class,     'index'])    ->name('admin.index');
    Route::get('/admin/export',                   [AdminController::class,     'export'])   ->name('admin.export');
    Route::get('/admin/status/{status}',          [AdminController::class,     'status'])   ->name('admin.status');
    Route::get('/admin/set/admin/{user}',         [AdminController::class,     'setAdmin']) ->name('admin.setAdmin');
    Route::get('/admin/get/admin/{user}',         [AdminController::class,     'getAdmin']) ->name('admin.getAdmin');
});