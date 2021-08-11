<?php

use App\Http\Controllers\Api\IssueController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* ISSUE */
Route::middleware('auth:api')->get('/issue', function (Request $request) {
    return $request->issue();
});

//this single-handedly attaches routes to all the methods in IssueController e.g. show, store etc
Route::apiResource('issue', IssueController::class);

/* PROJECT */
Route::middleware('auth:api')->get('/project', function (Request $request) {
    return $request->project();
});
Route::apiResource('project', ProjectController::class);

/* TASK */
Route::middleware('auth:api')->get('/task', function (Request $request) {
    return $request->task();
});
Route::apiResource('task', TaskController::class);
