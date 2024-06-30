<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisclosureController;
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

    Route::get('/disclosures', [DisclosureController::class, 'index'])->name('disclosures');

    Route::get('/contact', [ContactController::class, 'index'])->name('contact');

    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    Route::prefix('admin')->middleware('admin')->group(function() {

        Route::get('/', [DashboardController::class, 'admin'])->name('admin.home');

        Route::get('members', [MemberController::class, 'admin'])->name('admin.members');

        Route::get('members/{user}', [MemberController::class, 'show'])->name('admin.members.show');

        Route::post('approve', [MemberController::class, 'approve'])->name('admin.members.approve');

        Route::post('delete', [MemberController::class, 'destroy'])->name('admin.members.destroy');

        Route::get('/disclosures', [DisclosureController::class, 'index'])->name('admin.disclosures');

        Route::get('/contact', [ContactController::class, 'index'])->name('admin.contact');

        Route::post('/contact', [ContactController::class, 'store'])->name('admin.contact.store');

    });
});