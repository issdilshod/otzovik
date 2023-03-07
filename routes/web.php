<?php

use App\Http\Controllers\Admin\Account\AuthController;
use App\Http\Controllers\Admin\Account\UserController;
use App\Http\Controllers\Admin\Blog\ArticleController;
use App\Http\Controllers\Admin\Blog\CommentController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Review\ReviewController;
use App\Http\Controllers\Admin\Setting\CityController;
use App\Http\Controllers\Admin\Setting\EducationLevelController;
use App\Http\Controllers\Admin\Setting\DirectionController;
use App\Http\Controllers\Admin\Setting\EducationTypeController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\University\UniversityController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/**
 * MAIN ROUTES
 */
Route::get('/', [MainController::class, 'index']);

Route::get('/poisk/{slug1?}/{slug2?}/{slug3?}', [MainController::class, 'search']);

Route::get('/poisk2/{slug1?}', [MainController::class, 'search2']);

Route::get('/universitety/{slug1?}/{slug2?}/{slug3?}', [MainController::class, 'universities']);
Route::get('/universitet/{university_slug?}', [MainController::class, 'university']);
Route::get('/universitet/{university_slug?}/{slug1?}', [MainController::class, 'university']);
Route::get('/dobavit-vuz', [MainController::class, 'university_add']);

Route::get('/otzyvy', [MainController::class, 'reviews']);
Route::get('/otzyvy/{slug1?}', [MainController::class, 'reviews']);
Route::get('/otzyv/{review_number?}', [MainController::class, 'review']);
Route::get('/dobavit-otzyv/{university_slug?}', [MainController::class, 'review_add']);

Route::get('/posti', [MainController::class, 'articles']);
Route::get('/posti/{slug1?}', [MainController::class, 'articles']);
Route::get('/post/{article_slug}', [MainController::class, 'article']);

Route::get('/o-service', [MainController::class, 'about']);
Route::get('/faq', [MainController::class, 'faq']);
Route::get('/uchebnim-zavedeniyam', [MainController::class, 'educational']);
Route::get('/top-universitety', [MainController::class, 'top']);

Route::get('/legal', [MainController::class, 'legal']);
Route::get('/policy', [MainController::class, 'policy']);

/**
 * ADMIN ROUTES
 */
Route::get('admin/', [AuthController::class, 'index']);
Route::get('admin/login', [AuthController::class, 'index']);
Route::post('admin/login', [AuthController::class, 'login']);
Route::get('admin/logout', [AuthController::class, 'logout']);

Route::middleware(['auth.custom'])->group(function (){

    // dashboard
    Route::get('admin/dashboard', [DashboardController::class, 'index']);

    // universities
    Route::get('admin/universities', [UniversityController::class, 'index']);
    Route::post('admin/university', [UniversityController::class, 'store']);
    Route::get('admin/university/{id?}', [UniversityController::class, 'get']);
    Route::put('admin/university/{id}', [UniversityController::class, 'update']);
    Route::delete('admin/university/{id}', [UniversityController::class, 'destroy']);

    // reviews
    Route::get('admin/reviews', [ReviewController::class, 'index']);
    Route::post('admin/review', [ReviewController::class, 'store']);
    Route::get('admin/review/{id?}', [ReviewController::class, 'get']);
    Route::put('admin/review/{id}', [ReviewController::class, 'update']);
    Route::delete('admin/review/{id}', [ReviewController::class, 'destroy']);

    // articles
    Route::get('admin/blog/articles', [ArticleController::class, 'index']);
    Route::post('admin/blog/article', [ArticleController::class, 'store']);
    Route::get('admin/blog/article/{id?}', [ArticleController::class, 'show']);
    Route::put('admin/blog/article/{id}', [ArticleController::class, 'update']);
    Route::delete('admin/blog/article/{id}', [ArticleController::class, 'destroy']);

    // comments
    Route::get('admin/blog/comments', [CommentController::class, 'index']);
    //Route::post('admin/blog/comment', [CommentController::class, 'store']);
    Route::get('admin/blog/comment/{id?}', [CommentController::class, 'show']);
    Route::put('admin/blog/comment/{id}', [CommentController::class, 'update']);
    Route::delete('admin/blog/comment/{id}', [CommentController::class, 'destroy']);

    // users
    Route::get('admin/users', [UserController::class, 'index']);
    Route::post('admin/user', [UserController::class, 'store']);
    Route::get('admin/user/{id?}', [UserController::class, 'get']);
    Route::put('admin/user/{id}', [UserController::class, 'update']);
    Route::delete('admin/user/{id}', [UserController::class, 'destroy']);

    // cities
    Route::get('admin/settings/cities', [CityController::class, 'index']);
    Route::post('admin/settings/city', [CityController::class, 'store']);
    Route::get('admin/settings/city/{id?}', [CityController::class, 'show']);
    Route::put('admin/settings/city/{id}', [CityController::class, 'update']);
    Route::delete('admin/settings/city/{id}', [CityController::class, 'destroy']);

    // education level
    Route::get('admin/settings/education_levels', [EducationLevelController::class, 'index']);
    Route::post('admin/settings/education_level', [EducationLevelController::class, 'store']);
    Route::get('admin/settings/education_level/{id?}', [EducationLevelController::class, 'show']);
    Route::put('admin/settings/education_level/{id}', [EducationLevelController::class, 'update']);
    Route::delete('admin/settings/education_level/{id}', [EducationLevelController::class, 'destroy']);

    // directions
    Route::get('admin/settings/directions', [DirectionController::class, 'index']);
    Route::post('admin/settings/direction', [DirectionController::class, 'store']);
    Route::get('admin/settings/direction/{id?}', [DirectionController::class, 'get']);
    Route::put('admin/settings/direction/{id}', [DirectionController::class, 'update']);
    Route::delete('admin/settings/direction/{id}', [DirectionController::class, 'destroy']);

    // education type
    Route::get('admin/settings/education-types', [EducationTypeController::class, 'index']);
    Route::post('admin/settings/education-type', [EducationTypeController::class, 'store']);
    Route::get('admin/settings/education-type/{id?}', [EducationTypeController::class, 'get']);
    Route::put('admin/settings/education-type/{id}', [EducationTypeController::class, 'update']);
    Route::delete('admin/settings/education-type/{id}', [EducationTypeController::class, 'destroy']);

    // setting
    Route::get('/admin/settings/templates/index', [SettingController::class, 'index']);
    Route::get('/admin/settings/templates/search', [SettingController::class, 'search']);
    Route::get('/admin/settings/templates/search2', [SettingController::class, 'search2']);
    Route::get('/admin/settings/templates/universities', [SettingController::class, 'universities']);
    Route::get('/admin/settings/templates/university', [SettingController::class, 'university']);
    Route::get('/admin/settings/templates/reviews', [SettingController::class, 'reviews']);
    Route::get('/admin/settings/templates/review', [SettingController::class, 'review']);
    Route::get('/admin/settings/templates/review_add', [SettingController::class, 'review_add']);
    Route::get('/admin/settings/templates/articles', [SettingController::class, 'articles']);
    Route::get('/admin/settings/templates/about', [SettingController::class, 'about']);
    Route::get('/admin/settings/templates/faq', [SettingController::class, 'faq']);
    Route::get('/admin/settings/templates/educational', [SettingController::class, 'educational']);

});
