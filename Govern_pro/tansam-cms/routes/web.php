<?php

use App\Http\Controllers\CourseRegistrationController;
use App\Http\Controllers\HackathonController;
use App\Http\Controllers\JobapplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MediaCategoryController;
use App\Http\Controllers\MediaItemController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkshopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrepreneurshipController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventsController;

Route::get('/login',[LoginController::class, 'showLoginForm'])->name('loginForm');
Route::post('/login',[LoginController::class, 'login'])->name('login');

Route::post('/logout',[LoginController::class, 'logout'])->name('logout');

Route::middleware(['admin'])->group(function() {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // User related routes
    Route::get('/users',[UserController::class,'index'])->name('users.show');
    Route::get('/user/create',[UserController::class, 'create'])->name('users.create');
    Route::post('/user/store',[UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}',[UserController::class, 'edit'])->name('users.edit');
    Route::post('/user/update/{id}',[UserController::class, 'update'])->name('users.update');

    // Entrepreneurship model routes
    Route::get('/entrepreneurship/list', [EntrepreneurshipController::class, 'index'])->name('entrepreneurship.list');
    Route::get('/entrepreneurship/create', [EntrepreneurshipController::class, 'create'])->name('entrepreneurship.create');
    Route::post('/entrepreneurship/add', [EntrepreneurshipController::class, 'add'])->name('entrepreneurship.add');
    Route::get('/entrepreneurship/edit/{id}', [EntrepreneurshipController::class, 'editForm'])->name('entrepreneurship.editForm');
    Route::patch('/entrepreneurship/edit/{id}', [EntrepreneurshipController::class, 'edit'])->name('entrepreneurship.edit');
    Route::delete('/entrepreneurship/delete/{id}', [EntrepreneurshipController::class, 'delete'])->name('entrepreneurship.delete');

    // Event model routes
    Route::get('/events/list', [EventsController::class, 'index'])->name('events.list');
    Route::get('/events/create', [EventsController::class, 'create'])->name('events.create');
    Route::post('/events/add', [EventsController::class, 'add'])->name('events.add');
    Route::get('/events/edit/{id}', [EventsController::class, 'editForm'])->name('events.editForm');
    Route::patch('/events/edit/{id}', [EventsController::class, 'edit'])->name('events.edit');
    Route::delete('/events/delete/{id}', [EventsController::class, 'delete'])->name('events.delete');

    // Hackathon model routes
    Route::get('/hackathons/list',[HackathonController::class, 'index'])->name('hackathons.list');
    Route::get('/hackathons/create',[HackathonController::class, 'create'])->name('hackathons.create');
    Route::post('/hackathons/add',[HackathonController::class, 'add'])->name('hackathons.add');
    Route::get('/hackathons/edit/{id}', [HackathonController::class, 'editForm'])->name('hackathons.editForm');
    Route::patch('/hackathons/edit/{id}', [HackathonController::class, 'edit'])->name('hackathons.edit');
    Route::delete('/hackathons/delete/{id}', [HackathonController::class, 'delete'])->name('hackathons.delete');

    // Jobs model routes
    Route::get('/jobs/list',[JobController::class, 'index'])->name('jobs.list');
    Route::get('/jobs/create',[JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs/add',[JobController::class, 'add'])->name('jobs.add');
    Route::get('/jobs/edit/{id}', [JobController::class, 'editForm'])->name('jobs.editForm');
    Route::patch('/jobs/edit/{id}', [JobController::class, 'edit'])->name('jobs.edit');
    Route::delete('/jobs/delete/{id}', [JobController::class, 'delete'])->name('jobs.delete');

    // MediaCategories model routes
    Route::get('/mediaCategories/list',[MediaCategoryController::class, 'index'])->name('mediaCategories.list');
    Route::get('/mediaCategories/create',[MediaCategoryController::class, 'create'])->name('mediaCategories.create');
    Route::post('/mediaCategories/add',[MediaCategoryController::class, 'add'])->name('mediaCategories.add');
    Route::get('/mediaCategories/edit/{id}', [MediaCategoryController::class, 'editForm'])->name('mediaCategories.editForm');
    Route::patch('/mediaCategories/edit/{id}', [MediaCategoryController::class, 'edit'])->name('mediaCategories.edit');
    Route::delete('/mediaCategories/delete/{id}', [MediaCategoryController::class, 'delete'])->name('mediaCategories.delete');

    // MediaItems model routes
    Route::get('/mediaItems/list',[MediaItemController::class, 'index'])->name('mediaItems.list');
    Route::get('/mediaItems/create',[MediaItemController::class, 'create'])->name('mediaItems.create');
    Route::post('/mediaItems/add',[MediaItemController::class, 'add'])->name('mediaItems.add');
    Route::get('/mediaItems/edit/{id}', [MediaItemController::class, 'editForm'])->name('mediaItems.editForm');
    Route::patch('/mediaItems/edit/{id}', [MediaItemController::class, 'edit'])->name('mediaItems.edit');
    Route::delete('/mediaItems/delete/{id}', [MediaItemController::class, 'delete'])->name('mediaItems.delete');

    // News model routes
    Route::get('/news/list',[NewsController::class, 'index'])->name('news.list');
    Route::get('/news/create',[NewsController::class, 'create'])->name('news.create');
    Route::post('/news/add',[NewsController::class, 'add'])->name('news.add');
    Route::get('/news/edit/{id}', [NewsController::class, 'editForm'])->name('news.editForm');
    Route::patch('/news/edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
    Route::delete('/news/delete/{id}', [NewsController::class, 'delete'])->name('news.delete');

    // Sliders model routes
    Route::get('/sliders/list',[SliderController::class, 'index'])->name('sliders.list');
    Route::get('/sliders/create',[SliderController::class, 'create'])->name('sliders.create');
    Route::post('/sliders/add',[SliderController::class, 'add'])->name('sliders.add');
    Route::get('/sliders/edit/{id}', [SliderController::class, 'editForm'])->name('sliders.editForm');
    Route::patch('/sliders/edit/{id}', [SliderController::class, 'edit'])->name('sliders.edit');
    Route::delete('/sliders/delete/{id}', [SliderController::class, 'delete'])->name('sliders.delete');

    // Workshop model routes
    Route::get('/workshops/list',[WorkshopController::class, 'index'])->name('workshops.list');
    Route::get('/workshops/create',[WorkshopController::class, 'create'])->name('workshops.create');
    Route::post('/workshops/add',[WorkshopController::class, 'add'])->name('workshops.add');
    Route::get('/workshops/edit/{id}', [WorkshopController::class, 'editForm'])->name('workshops.editForm');
    Route::patch('/workshops/edit/{id}', [WorkshopController::class, 'edit'])->name('workshops.edit');
    Route::delete('/workshops/delete/{id}', [WorkshopController::class, 'delete'])->name('workshops.delete');

    // Job Application routes
    Route::get('/jobApplications',[JobapplicationController::class, 'show'])->name('jobApps.show');
    Route::get('/jobApplications/{id}/resume', [JobapplicationController::class, 'downloadResume']);
    Route::post('/jobApplications/{id}/status', [JobapplicationController::class, 'updateStatus'])->name('jobApps.update');

    // Course Registration routes
    Route::get('/course-registrations',[CourseRegistrationController::class, 'show'])->name('courseRegs.show');
});