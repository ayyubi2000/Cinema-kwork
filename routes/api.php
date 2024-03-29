<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LatestNewController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\AwardsPhotoController;
use App\Http\Controllers\PostComentaryController;
use App\Http\Controllers\LatestNewsComentaryController;
use App\Http\Controllers\EmailVerificationCodeController;


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);
Route::post('email-verification', [EmailVerificationCodeController::class, 'sendEmailVerification']);
Route::post('check-email-verification', [EmailVerificationCodeController::class, 'checkEmailVerification']);

Route::apiResource('user', UserController::class);
Route::middleware(['auth:sanctum', 'auth.permission'])->group(
    function () {
        Route::apiResource('country', CountryController::class);
        Route::apiResource('category', CategoryController::class);
        Route::apiResource('studio', StudioController::class);
        Route::apiResource('movie', MovieController::class);
        Route::apiResource('genre', GenreController::class);
        Route::apiResource('awards-photos', AwardsPhotoController::class);
        Route::apiResource('serie', SerieController::class);
        Route::apiResource('rating', RatingController::class);
        Route::apiResource('profession', ProfessionController::class);
        Route::apiResource('actor', ActorController::class);
        Route::apiResource('latest-new', LatestNewController::class);
        Route::apiResource('latest-new-comentary', LatestNewsComentaryController::class);
        Route::apiResource('tag', TagController::class);
        Route::apiResource('post', PostController::class);
        Route::apiResource('status', StatusController::class);
        Route::apiResource('post-comentary', PostComentaryController::class);
        Route::get('logout', [AuthController::class, 'logout'])->name('user.logout');
        Route::post('update-yourself', [AuthController::class, 'updateYourself'])->name('user.updateYourself');
        Route::get('check-user-token', [AuthController::class, 'checkUserToken'])->name('user.checkUserToken');
        Route::get('role', [UserController::class, 'roles'])->name('roles');
        Route::post('/upload-file', [UploadFileController::class, 'upload'])->name('upload-file.index');
    }
);


Route::prefix('ui')->name('ui.')->group(function () {
    Route::apiResource('country', CountryController::class)->only(['index', 'show']);
    Route::apiResource('category', CategoryController::class)->only(['index', 'show']);
    Route::apiResource('studio', StudioController::class)->only(['index', 'show']);
    Route::apiResource('movie', MovieController::class)->only(['index', 'show']);
    Route::apiResource('genre', GenreController::class)->only(['index', 'show']);
    Route::apiResource('awards-photos', AwardsPhotoController::class)->only(['index', 'show']);
    Route::apiResource('serie', SerieController::class)->only(['index', 'show']);
    Route::apiResource('rating', RatingController::class)->only(['index', 'show']);
    Route::apiResource('profession', ProfessionController::class)->only(['index', 'show']);
    Route::apiResource('actor', ActorController::class)->only(['index', 'show']);
    Route::apiResource('latest-new', LatestNewController::class)->only(['index', 'show']);
    Route::apiResource('latest-new-comentary', LatestNewsComentaryController::class)->only(['index', 'show']);
    Route::apiResource('tag', TagController::class)->only(['index', 'show']);
    Route::apiResource('post', PostController::class)->only(['index', 'show']);
    Route::apiResource('status', StatusController::class)->only(['index', 'show']);
    Route::apiResource('post-comentary', PostComentaryController::class)->only(['index', 'show']);
    Route::post('/upload-file', [UploadFileController::class, 'upload'])->name('upload-file.index');
});


Route::get(
    'token-status',
    function () {
        return "not authorized";
    }
)->name(
        'token-status'
    );


// Route::get('mail', function () {
//     $data = [
//         'subject' => 'saloms',
//         'to' => 'ayubnematovaws@gmail.com',
//         'code' => 'ayubnematovaws@gmail.com',
//     ];

//     Mail::send(new VerificationMail($data));

//     return response()->json(['success' => true]);
// });