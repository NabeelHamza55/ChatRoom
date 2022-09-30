<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('signup', [AuthController::class, 'signUp'])->name('SignUp');
Route::post('signin', [AuthController::class, 'signIn'])->name('SignIn');
Route::post('social', [AuthController::class, 'socialLogin'])->name('SocialSignIn');
Route::middleware('auth:sanctum')->group(function () {
    Route::post('suggestion/add', [ApiController::class, 'submitSuggestion'])->name('SuggestionAdd');
    Route::post('report/add', [ApiController::class, 'submitReport'])->name('ReportAdd');
    Route::post('objective/add', [ApiController::class, 'createObjective'])->name('CreateObjective');
    Route::get('objective/{id}', [ApiController::class, 'fetchObjective'])->name('FetchObjective');
    Route::get('user/profile/{id}', [ApiController::class, 'fetchUserProfile'])->name('FetchUserProfile');
    Route::post('user/profile/update', [ApiController::class, 'updateUserProfile'])->name('UpdateUserProfile');
    Route::get('follow', [ApiController::class, 'follow'])->name('FollowUser');
    Route::get('block', [ApiController::class, 'block'])->name('BlockUser');
    Route::get('unfollow', [ApiController::class, 'unFollow'])->name('UnFollowUser');
    Route::get('unblock', [ApiController::class, 'unBlock'])->name('UnBlockUser');
    Route::get('followers/{id}', [ApiController::class, 'getFollowers'])->name('GetFollowers');
    Route::get('following/{id}', [ApiController::class, 'getFollowing'])->name('GetFollowings');
    Route::get('blocked-users/{id}', [ApiController::class, 'getBlockUser'])->name('GetBlockUser');
});
