<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file contains the web routes for your application. These routes are loaded by the RouteServiceProvider within a group
| which contains the "web" middleware group. The web routes handle requests from web browsers and render the appropriate
| views using Inertia.js.
|
*/

/**
 * The welcome route.
 *
 * This route renders the 'Welcome' view using Inertia.js and passes some data to the view, including whether the user can login
 * or register, the Laravel version, and the PHP version.
 */
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

/**
 * Authenticated routes group.
 *
 * This group contains routes that require the user to be authenticated and verified using Sanctum.
 * The 'config('jetstream.auth_session')' middleware is applied to use the appropriate session driver for Jetstream.
 * This group contains the 'dashboard' route which renders the 'Dashboard' view using Inertia.js.
 */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    /**
     * The dashboard route.
     *
     * This route renders the 'Dashboard' view using Inertia.js.
     */
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    /**
     * The resourceful routes for books.
     *
     * These routes are resourceful and map to the 'BookController' actions for CRUD operations on books.
     * The route names are customized using the 'names()' method to use 'books' as the route name for the 'index' action.
     */
    Route::resource(name:'books', controller:\App\Http\Controllers\BookController::class)
        ->names([
          'index' => 'books'
         ]);
    
     /**
     * The route for uploading books.
     *
     * This route maps to the 'upload' method in the 'BookController' to handle book uploads.
     */
    Route::post( '/upload-books', [\App\Http\Controllers\BookController::class, 'upload']);

    /**
     * The route for reverting book upload.
     *
     * This route maps to the 'uploadRevert' method in the 'BookController' to handle book upload revert.
     */
    Route::post( '/upload-books-revert', [\App\Http\Controllers\BookController::class, 'uploadRevert']);
});