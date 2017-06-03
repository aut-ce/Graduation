<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

\App\Http\Controllers\AuthController::routes();
\App\Http\Controllers\TestController::routes();
\App\Http\Controllers\HomeController::routes();
\App\Http\Controllers\AskController::routes();
\App\Http\Controllers\PersonalPageController::routes();
\App\Http\Controllers\ContentController::routes();
\App\Http\Controllers\SelectController::routes();
\App\Http\Controllers\BestController::routes();
\App\Http\Controllers\AdminController::routes();