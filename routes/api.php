<?php

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\DashboardController;
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
//User Profile routes
Route::get('profile', [UserController::class, 'profile']);
Route::put('profile', [UserController::class, 'updateProfile']);

/* CLIENT */
Route::middleware('auth:api')->get('/client', function (Request $request) {
    return $request->user();
});
Route::apiResource('client', ClientController::class);

/* INVOICE */
Route::middleware('auth:api')->get('/invoice', function (Request $request) {
    return $request->user();
});
Route::apiResource('invoice', InvoiceController::class);

/* ISSUE */
Route::middleware('auth:api')->get('/issue', function (Request $request) {
    return $request->user();
});
Route::apiResource('issue', IssueController::class);
Route::get('assignee', [IssueController::class, 'assignee']);

/* PROJECT */
Route::middleware('auth:api')->get('/project', function (Request $request) {
    return $request->user();
});

//custom routes should be placed above resource routes, to work
Route::get('project/member', [ProjectController::class, 'member']);
Route::post('project/member', [ProjectController::class, 'storeMember']);
Route::apiResource('project', ProjectController::class);

/* PERMISSION */
Route::middleware('auth:api')->get('/permission', function (Request $request) {
    return $request->user();
});
Route::apiResource('permission', PermissionController::class);

/* ROLE */
Route::middleware('auth:api')->get('/role', function (Request $request) {
    return $request->user();
});
Route::apiResource('role', RoleController::class);

/* TASK */
Route::middleware('auth:api')->get('/task', function (Request $request) {
    return $request->user();
});
Route::apiResource('task', TaskController::class);

/* DASHBOARD */
Route::middleware('auth:api')->get('/dashboard', function (Request $request) {
    return $request->user();
});
Route::apiResource('dashboard', DashboardController::class);
