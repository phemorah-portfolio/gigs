<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::get('/', [Controllers\ListingController::class, 'index'])->name('gigs.index');

Route::resource('listing', \App\Http\Controllers\ListingController::class);

Route::get('/dashboard', function (\Illuminate\Http\Request $request) {
    return view('dashboard', [
        // the listing variable here pulls from the authenticated user via the request object and its listing's relationship
        'listings' => $request->user()->listings
    ]);
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';

