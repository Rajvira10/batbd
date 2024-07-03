<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RoleController;
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

    
    Route::get('/news', [NewsController::class, 'index'])->name('news');

    Route::prefix('admin')->middleware('admin')->group(function() {

        Route::get('/', [DashboardController::class, 'admin'])->name('admin.home');

        Route::get('members', [MemberController::class, 'admin'])->name('admin.members');

        Route::get('members/{user}', [MemberController::class, 'show'])->name('admin.members.show');

        Route::post('approve', [MemberController::class, 'approve'])->name('admin.members.approve');

        Route::post('delete', [MemberController::class, 'destroy'])->name('admin.members.destroy');

        Route::get('/disclosures', [DisclosureController::class, 'admin'])->name('admin.disclosures');

        Route::post('/disclosures/store', [DisclosureController::class, 'store'])->name('admin.disclosures.store');

        Route::get('/contact', [ContactController::class, 'admin'])->name('admin.contacts');

        Route::get('show/{contact}', [ContactController::class, 'show'])->name('admin.contact.show');
  
        Route::get('user-roles/{user_id}', [MemberController::class , 'userRoles'])->name('users.user_roles');

        Route::post('user-roles/{user_id}', [MemberController::class, 'assignRoles'])->name('users.assign_roles');

        Route::get('role-permissions/{role_id}', [RoleController::class, 'rolePermissions'])->name('roles.role_permissions');
    
        Route::post('role-permissions/{role_id}', [RoleController::class, 'assignPermissions'])->name('roles.assign_permissions');

        Route::prefix("roles")->group(function() {
            Route::get('/', [RoleController::class, 'index'])->name('roles.index');
            Route::get('create', [RoleController::class, 'create'])->name('roles.create');
            Route::post('store', [RoleController::class, 'store'])->name('roles.store');
            Route::get('edit/{role}', [RoleController::class, 'edit'])->name('roles.edit');
            Route::post('update/{role}', [RoleController::class, 'update'])->name('roles.update');
            Route::post('delete', [RoleController::class, 'destroy'])->name('roles.destroy');
        });

        Route::prefix('news')->group(function () {
            Route::get('/', [NewsController::class, 'admin'])->name('admin.news');
            Route::get('create', [NewsController::class, 'create'])->name('admin.news.create');
            Route::post('store', [NewsController::class, 'store'])->name('admin.news.store');
            Route::get('show/{news}', [NewsController::class, 'show'])->name('admin.news.show');
            Route::get('edit/{news}', [NewsController::class, 'edit'])->name('admin.news.edit');
            Route::post('update/{news}', [NewsController::class, 'update'])->name('admin.news.update');
            Route::post('delete', [NewsController::class, 'destroy'])->name('admin.news.destroy');
            Route::post('publish', [NewsController::class, 'publish'])->name('admin.news.publish');
            Route::post('unpublish', [NewsController::class, 'unpublish'])->name('admin.news.unpublish');
            Route::post('archive', [NewsController::class, 'archive'])->name('admin.news.archive');
            Route::get('archive', [NewsController::class, 'archiveIndex'])->name('admin.news.archive.index');
        });
    });
});