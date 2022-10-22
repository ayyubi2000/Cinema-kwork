<?php
use App\Http\Controllers\AwardsPhotoController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieNewController;
use App\Http\Controllers\SerieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StudioNewController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\EmailVerificationCodeController;


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);
Route::post('email-verification', [EmailVerificationCodeController::class, 'sendEmailVerification']);
Route::post('check-email-verification', [EmailVerificationCodeController::class, 'checkEmailVerification']);

Route::apiResource('user', UserController::class);
Route::middleware(['auth:sanctum', 'auth.permission'])->group(function () {
    Route::apiResource('country', CountryController::class);
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('studio-news', StudioNewController::class);
    Route::apiResource('studio', StudioController::class);
    Route::apiResource('movie', MovieController::class);
    Route::apiResource('genre', GenreController::class);
    Route::apiResource('awards-photos', AwardsPhotoController::class);
    Route::apiResource('serie', SerieController::class);
    Route::apiResource('movie-new', MovieNewController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('user.logout');
    Route::post('update-yourself', [AuthController::class, 'updateYourself'])->name('user.updateYourself');
    Route::get('check-user-token', [AuthController::class, 'checkUserToken'])->name('user.checkUserToken');
    Route::get('role', [UserController::class, 'roles'])->name('roles');
    Route::post('/upload-file', [UploadFileController::class, 'upload'])->name('upload-image.index');
});


// Route::prefix('ui')->name('ui.')->group(function () {
//     Route::apiResource('region', RegionController::class)->only(['index', 'show']);
// });


Route::get('token-status', function () {
    return "not authorized";
})->name('token-status');





// Route::get('mail', function () {
//     $data = [
//         'subject' => 'saloms',
//         'to' => 'ayubnematovaws@gmail.com',
//         'code' => 'ayubnematovaws@gmail.com',
//     ];

//     Mail::send(new VerificationMail($data));

//     return response()->json(['success' => true]);
// });