<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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



Route::get('/login', function () {
    return inertia('Login');
})->middleware('guest')->name('login');


Route::get('/register', function () {
    return inertia('Register');
})->middleware('guest')->name('register');

Route::post('authenticate', [AuthenticationController::class, 'authenticate'])->name('authenticate');

Route::post('register', [AuthenticationController::class, 'register'])->name('register');

Route::group(['middleware' => ['auth:web']], function() {

    Route::get('email-confirmation/{user}', [AuthenticationController::class, 'emailConfirmation'])->name('email-confirmation');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request, $id) {
        $user = User::findOrFail($id);
        $user->markEmailAsVerified();

        return inertia('EmailVerified');
    })->name('verification.verify');

    Route::post('/email/resend', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');


    Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::post('/profile/update', [DashboardController::class, 'updateProfile'])->name('update-profile');

    Route::get('/members', [MemberController::class, 'index'])->name('members');

    Route::get('/members/{user}', [MemberController::class, 'show'])->name('members.show');

});