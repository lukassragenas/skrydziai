<?php

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/pagalba', [App\Http\Controllers\HomeController::class, 'support'])->name('support');
Route::get('/skrydziai', [App\Http\Controllers\HomeController::class, 'findFlight'])->name('findFlight');
Route::post('/pagalba/siusti', [App\Http\Controllers\HomeController::class, 'sendMail'])->name('send.email');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => 'auth'], function () {
    Route::post('/skrydziai/rezervacija', [App\Http\Controllers\HomeController::class, 'reserveFlight'])->name('reserve');
    Route::get('/mano-profilis/rezrvuota', [App\Http\Controllers\HomeController::class, 'getReserved'])->name('reserved');
    Route::get('/mano-profilis/apmoketa', [App\Http\Controllers\HomeController::class, 'getPaid'])->name('paid');
    Route::get('/mano-profilis', [App\Http\Controllers\HomeController::class, 'getAccount'])->name('profile');
    Route::post('/mano-profilis/el-pastas', [App\Http\Controllers\HomeController::class, 'updateEmail'])->name('email');
    Route::post('/mano-profilis/slaptazodis', [App\Http\Controllers\HomeController::class, 'passwordUpdate'])->name('password');
    Route::post('/mano-profilis/stripe', [App\Http\Controllers\StripePaymentController::class, 'stripePost'])->name('stripe.post');
    Route::post('/mano-profilis/atsaukti/{id}', [App\Http\Controllers\HomeController::class, 'deleteFlight'])->name('delete');
});
