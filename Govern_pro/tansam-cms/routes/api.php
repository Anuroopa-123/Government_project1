<?php
use App\Http\Controllers\API\CourseRegistrationController;
use App\Http\Controllers\API\FrontendResourceController;
use App\Http\Controllers\API\JobapplicationController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

// All event API's
Route::get('/entrepreneurships',[FrontendResourceController::class, 'entrepreneurships']);
Route::get('/events/{category}',[FrontendResourceController::class, 'events']);
Route::get('/hackathons',[FrontendResourceController::class, 'hackathons']);
Route::get('/jobs',[FrontendResourceController::class, 'jobs']);
Route::get('/media-categories',[FrontendResourceController::class, 'mediaCategories']);
Route::get('/media-items/{category}',[FrontendResourceController::class, 'mediaItems']);
Route::get('/news',[FrontendResourceController::class, 'news']);
Route::get('/sliders',[FrontendResourceController::class, 'sliders']);
Route::get('/workshops',[FrontendResourceController::class, 'workshops']);

// Course registration handling API
Route::post('/course-registrations',[CourseRegistrationController::class, 'store']);

// Job Applications
Route::post('/job-applications',[JobapplicationController::class, 'store']);

// Contact routes
Route::post('/contact-us',[ContactusController::class, 'store']);

Route::get('/header-content', [FrontendResourceController::class, 'getHeaderContent']);


Route::get('/hero-content', [FrontendResourceController::class, 'heroContent']);

//members routes 
Route::get('/members', [MemberController::class, 'index']);
Route::post('/members', [MemberController::class, 'store']);


