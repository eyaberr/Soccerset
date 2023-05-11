<?php

use App\Http\Controllers\Api\ChildController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TrainerEventsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


//Route::apiResource('groups', GroupController::class);
//Route::apiResource('children', ChildController::class);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
//Route::get('/users', [AuthController::class, 'index']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users/events', [TrainerEventsController::class, 'show'])->middleware('auth:sanctum');
//Route::group(['middleware' => ['auth:sanctum']], function () {
//    Route::get('/users', [AuthController::class, 'index']);
//});

//TODO connected as a trainer => list of events assigned to that trainer : DONE
//TODO connected as a parent => list of events assigned to their children : DONE
//TODO connected as a parent or trainer => GET event details
//TODO connected as a trainer => PUT update event subscription two possible parameters boolean attendance  json stats

