<?php

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\IssueController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
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

/* USER */
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('user', UserController::class);

/* CLIENT */
Route::middleware('auth:api')->get('/client', function (Request $request) {
    return $request->client();
});
Route::apiResource('client', ClientController::class);

/* INVOICE */
Route::middleware('auth:api')->get('/invoice', function (Request $request) {
    return $request->invoice();
});
Route::apiResource('invoice', InvoiceController::class);

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

/* PERMISSION */
Route::middleware('auth:api')->get('/permission', function (Request $request) {
    return $request->permission();
});
Route::apiResource('permission', PermissionController::class);

/* ROLE */
Route::middleware('auth:api')->get('/role', function (Request $request) {
    return $request->role();
});
Route::apiResource('role', RoleController::class);

/* TASK */
Route::middleware('auth:api')->get('/task', function (Request $request) {
    return $request->task();
});
Route::apiResource('task', TaskController::class);
