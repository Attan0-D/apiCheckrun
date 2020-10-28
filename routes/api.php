<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListqController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::post('user/login', [UserController::class, 'login']);


Route::resource('user', UserController::class );
Route::resource('list', ListqController::class );
Route::resource('category', CategoryController::class );
Route::resource('question', QuestionController::class );
Route::resource('answer', AnswerController::class );
