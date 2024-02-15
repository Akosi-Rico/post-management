<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Client\ClientPostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__.'/auth.php';
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::resource("/home", ClientPostController::class);
    Route::resource("/account", AccountController::class);
    Route::post("/account/comment", [AccountController::class, 'canCreateOrUpdateComment'])->name("post.comment");
    Route::post("/account/comment/delete", [AccountController::class, 'canDeleteComment'])->name("delete.comment");
    Route::post("/account/filter/status",  [AccountController::class, 'canFilterPost'])->name("filter.post");
    Route::post("/account/rate/post",  [AccountController::class, 'canRatePost'])->name("rate.post");
});


