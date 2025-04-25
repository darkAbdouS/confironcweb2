<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SpeakerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ScheduleController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/calendar', [ScheduleController::class, 'index']);

Route::get('/become-speaker', [SpeakerController::class, 'create']);
Route::post('/become-speaker', [SpeakerController::class, 'store']);
Route::get('/admin/requests', [AdminController::class, 'index']);
Route::post('/admin/approve/{id}', [AdminController::class, 'approve']);
Route::get('/schedule', [ScheduleController::class, 'index']);
Route::get('/admin/schedule/{id}', [AdminController::class, 'scheduleForm']);
Route::post('/admin/schedule/{id}', [AdminController::class, 'setSchedule']);


