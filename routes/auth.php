<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', 'AuthenticatedSessionController@create') -> middleware('guest') -> name('login');
Route::post('/login', 'AuthenticatedSessionController@store') -> middleware('guest') -> name('login');
Route::view('/login/success', 'auth.login-success') -> name('login-success');

Route::view('/logout-confirm', 'auth.logout-confirm') -> middleware('auth') -> name('logout-confirm');
Route::get('/logout', 'AuthenticatedSessionController@destroy') -> middleware('auth') -> name('logout');

Route::group([ 'prefix' => '/register/create-new-staff-member' ], function()
{
    Route::get('/', 'RegisteredUserController@create') -> name('register');
    Route::post('/', 'RegisteredUserController@store') -> name('register');
    Route::view('/success', 'auth.register-success') -> name('register-success');
});

Route::get('/change-password', 'ChangePasswordController@create')  -> middleware('auth') -> name('change-password');
Route::post('/change-password', 'ChangePasswordController@store')  -> middleware('auth') -> name('change-password');
Route::view('/change-password/success', 'auth.change-password-success') -> middleware('auth') -> name('change-password.success');

// // forgot password get
// Route::get('/forgot-password', 'PasswordResetLinkController@create') -> middleware('guest') -> name('password.request');
// // forgot password post
// Route::post('/forgot-password', 'PasswordResetLinkController@store') -> middleware('guest') -> name('password.email');
// // forgot password email sent get
// Route::get('/forgot-password-email-sent', 'PasswordResetLinkController@sent') -> middleware('guest') -> name('password.emailsent');

// // TODO: integrate
// Route::get('/reset-password/{token}/{email}', 'NewPasswordController@create') -> middleware('guest') -> name('password.reset');
// // TODO: integrate
// Route::post('/reset-password', 'NewPasswordController@store') -> middleware('guest') -> name('password.update');

// // TODO: integrate
// Route::get('/verify-email', 'EmailVerificationPromptController@__invoke') -> middleware('auth') -> name('verification.notice');
// // TODO: integrate
// Route::get('/verify-email/{id}/{hash}', 'VerifyEmailController@__invoke') -> middleware(['auth', 'signed', 'throttle:6,1']) -> name('verification.verify');
// // TODO: integrate
// Route::post('/email/verification-notification', 'EmailVerificationNotificationController@store') -> middleware(['auth', 'throttle:6,1']) -> name('verification.send');

// Route::get('/confirm-password', 'ConfirmablePasswordController@show') -> middleware('auth') -> name('password.confirm');
// Route::post('/confirm-password', 'ConfirmablePasswordController@store') -> middleware('auth') -> name('password.confirm');
