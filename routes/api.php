<?php

use App\Http\Controllers\Admin\Blog\CommentController;
use App\Http\Controllers\Admin\Review\ReviewController;
use App\Http\Controllers\Admin\Setting\CityController;
use App\Http\Controllers\Admin\Setting\QaController;
use App\Http\Controllers\Admin\Setting\SeoController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Subscribe\SubscribeController;
use App\Http\Controllers\Admin\University\UniversityController;
use Illuminate\Support\Facades\Route;

Route::post('subscribe', [SubscribeController::class, 'api_store']);
Route::post('review', [ReviewController::class, 'api_store']);
Route::post('comment', [CommentController::class, 'api_store']);
Route::post('like', [CommentController::class, 'api_like']);
Route::get('cities/{name?}', [CityController::class, 'api_index']);
Route::post('university', [UniversityController::class, 'api_store']);

Route::middleware(['auth.bearer'])->group(function (){
    Route::put('setting/{key}', [SettingController::class, 'api_update']);

    // QAS
    Route::put('qa/{id}', [QaController::class, 'api_update']);
    Route::post('qa', [QaController::class, 'api_store']);

    // SEO
    Route::put('seo/{url}', [SeoController::class, 'api_update']);
});