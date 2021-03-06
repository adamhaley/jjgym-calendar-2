<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FullCalendarController;
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

Route::get('/',[FullCalendarController::class, 'index']);

Route::get('calendar',[FullCalendarController::class, 'events']);
Route::post('calendar/action',[FullCalendarController::class, 'action']);
