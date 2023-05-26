<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExerciseUserController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FeelingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MeasuringController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/measurement', [MeasuringController::class, 'store']);
    Route::get('/measurement', [MeasuringController::class, 'index']);
    Route::post('/exercise-practice', [ExerciseUserController::class, 'store']);
    Route::get('/reminders', [ReminderController::class, 'index']);
    Route::post('/reminders', [ReminderController::class, 'store']);
    Route::get('/messages', [MessageController::class, 'index']);
    Route::post('/messages', [MessageController::class, 'store']);
    Route::post('/feedbacks', [FeedbackController::class, 'store']);
    Route::get('/feedbacks/status', [FeedbackController::class, 'status']);
    Route::post('/exams', [ExamController::class, 'store']);
    Route::get('/exams', [ExamController::class, 'index']);
    Route::get('/feelings', [FeelingController::class, 'index']);
    Route::post('/feelings', [FeelingController::class, 'store']);
    Route::get('/notes', [NoteController::class, 'index']);
    Route::post('/notes', [NoteController::class, 'store']);
    Route::delete('/notes', [NoteController::class, 'delete']);
    Route::get('/reports', [ReportController::class, 'index']);
    Route::get('/reports/weekly', [ReportController::class, 'weekly']);
    Route::post('/reports', [ReportController::class, 'store']);
    Route::post('/logout', [LoginController::class, 'logout']);
});

// websocket on server
// websocket on client
// fix chat from panel
// mood chart
// arm charts options
// pictures and graphics
// checking weekly status updates
