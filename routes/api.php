<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    AuthController,
    UploadFileController,
    EmailVerificationCodeController,
};

Route::post('login', [AuthController::class , 'login']);
Route::post('register', [AuthController::class , 'register']);
Route::post('reset-password', [AuthController::class , 'resetPassword']);
Route::post('email-verification', [EmailVerificationCodeController::class , 'sendEmailVerification']);
Route::post('check-email-verification', [EmailVerificationCodeController::class , 'checkEmailVerification']);
Route::apiResource('user', UserController::class);

Route::middleware(['auth:sanctum', 'auth.permission'])->group(function () {
    Route::get('logout', [AuthController::class , 'logout']);
    Route::get('check-user-token', [AuthController::class , 'checkUserToken']);
    // Route::get('role', [UserController::class , 'roles'])->name('roles');
    // Route::apiResource('region', RegionController::class);
    // Route::get('region-state', [RegionController::class , 'paginatedListOfState'])->name('region.state');
    // Route::post('/upload-file', [UploadFileController::class , 'upload'])->name('upload-image.index');
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