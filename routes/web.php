<?php

use App\Http\Controllers\backend\bedsController;
use App\Http\Controllers\backend\CourseController;
use App\Http\Controllers\backend\hostelController;
use App\Http\Controllers\backend\roomsController;
use App\Http\Controllers\backend\wardenController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // courses
    Route::group(['prefix' => 'course'], function(){
        Route::get('/index',[CourseController::class, 'index'])->name('course.index');
        Route::get('/create',[CourseController::class, 'create'])->name('course.create');
        Route::post('/store',[CourseController::class, 'store'])->name('course.store');
        Route::get('/edit/{id}',[CourseController::class, 'edit'])->name('course.edit');
        Route::post('/update/{id}',[CourseController::class, 'update'])->name('course.update');
        Route::get('/delete/{id}',[CourseController::class, 'destroy'])->name('course.delete');
        Route::get('/data',[CourseController::class, 'data'])->name('course.data');

    });

    // warden
    Route::group(['prefix' => 'warden'], function(){
        Route::get('/index',[wardenController::class, 'index'])->name('warden.index');
        Route::get('/create',[wardenController::class, 'create'])->name('warden.create');
        Route::post('/store',[wardenController::class, 'store'])->name('warden.store');
        Route::get('/edit/{id}',[wardenController::class, 'edit'])->name('warden.edit');
        Route::post('/update/{id}',[wardenController::class, 'update'])->name('warden.update');
        Route::get('/delete/{id}',[wardenController::class, 'destroy'])->name('warden.delete');
        Route::get('/data',[wardenController::class, 'data'])->name('warden.data');

    });
    
    // hostel
    Route::group(['prefix' => 'Hostel'], function(){
        Route::get('/index',[hostelController::class, 'index'])->name('hostel.index');
        Route::get('/create',[hostelController::class, 'create'])->name('hostel.create');
        Route::post('/store',[hostelController::class, 'store'])->name('hostel.store');
        Route::get('/edit/{id}',[hostelController::class, 'edit'])->name('hostel.edit');
        Route::post('/update/{id}',[hostelController::class, 'update'])->name('hostel.update');
        Route::get('/delete/{id}',[hostelController::class, 'destroy'])->name('hostel.delete');
        Route::get('/data',[hostelController::class, 'data'])->name('hostel.data');

    });

    // rooms
    Route::group(['prefix' => 'Rooms'], function(){
        Route::get('/index',[roomsController::class, 'index'])->name('rooms.index');
        Route::get('/create',[roomsController::class, 'create'])->name('rooms.create');
        Route::post('/store',[roomsController::class, 'store'])->name('rooms.store');
        Route::get('/edit/{id}',[roomsController::class, 'edit'])->name('rooms.edit');
        Route::post('/update/{id}',[roomsController::class, 'update'])->name('rooms.update');
        Route::get('/delete/{id}',[roomsController::class, 'destroy'])->name('rooms.delete');
        Route::get('/data',[roomsController::class, 'data'])->name('rooms.data');

    });

    // beds
    Route::group(['prefix' => 'Beds'], function(){
        Route::get('/index',[bedsController::class, 'index'])->name('beds.index');
        Route::get('/create',[bedsController::class, 'create'])->name('beds.create');
        Route::post('/store',[bedsController::class, 'store'])->name('beds.store');
        Route::get('/edit/{id}',[bedsController::class, 'edit'])->name('beds.edit');
        Route::post('/update/{id}',[bedsController::class, 'update'])->name('beds.update');
        Route::get('/delete/{id}',[bedsController::class, 'destroy'])->name('beds.delete');
        Route::get('/data',[bedsController::class, 'data'])->name('beds.data');

    });
});

require __DIR__.'/auth.php';
