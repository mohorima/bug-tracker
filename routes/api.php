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
Route::apiResource('user', UserController::class);
//User Profile routes
Route::get('profile', [UserController::class, 'profile']);
Route::put('profile', [UserController::class, 'updateProfile']);

/* CLIENT */
Route::apiResource('client', ClientController::class);

/* INVOICE */
Route::apiResource('invoice', InvoiceController::class);

/* ISSUE */
Route::get('assignee', [IssueController::class, 'assignee']);
Route::apiResource('issue', IssueController::class);

/* PROJECT */
//custom routes should be placed above resource routes, to work
Route::get('project/assigned-member/{id}', [
    ProjectController::class,
    'assignedMember',
]);
Route::get('project/member', [ProjectController::class, 'member']);
Route::post('project/member', [ProjectController::class, 'storeMember']);
Route::apiResource('project', ProjectController::class);

/* PERMISSION */
Route::apiResource('permission', PermissionController::class);

/* ROLE */
Route::post('role/permission', [RoleController::class, 'storePermission']);
Route::apiResource('role', RoleController::class);

/* TASK */
Route::apiResource('task', TaskController::class);

/* DASHBOARD */
Route::apiResource('dashboard', DashboardController::class);
