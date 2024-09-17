<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\stripeController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;



Route::get('/', [JobController::class, 'index']);
Route::get('/search', SearchController::class);
Route::get('/tags/{tag:name}', TagController::class); // should do that {tag:name} otherwise it'll search for id NOT the name

Route::get('/jobs/create', [JobController::class, 'create'])->middleware('auth');
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create']);
    Route::post('/login', [SessionController::class, 'store']);
});
// or you can do this instead of grouping
// Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest');
// Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');
// Route::get('/login', [SessionController::class, 'create'])->middleware('guest');
// Route::post('/login', [SessionController::class, 'store'])->middleware('guest');

Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get('/test', function () {
    return view('test');
});

Route::post('stripe', [stripeController::class, 'stripe'])->name('stripe');
Route::get('success', [stripeController::class, 'success'])->name('success');
Route::get('cancel', [stripeController::class, 'cancel'])->name('cancel');

