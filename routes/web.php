<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

/* USER */
// Route::get('/user', [UserController::class, 'index'])->name('userindex');
// //create
// Route::get('/user/create', [UserController::class, 'create'])->name(
//     'usercreate'
// );
// //store
// Route::post('/user', [UserController::class, 'store']);
// //show
// Route::get('/user/{id}/show', [UserController::class, 'show'])->name(
//     'usershow'
// );
// //edit
// Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name(
//     'useredit'
// );
// //update
// Route::put('/user/{id}', [UserController::class, 'update']);
// //destroy
// Route::delete('/user/{id}', [UserController::class, 'destroy']);

Auth::routes([
    'register' => false,
]);

Route::get('/home', [
    App\Http\Controllers\HomeController::class,
    'index',
])->name('home');

Route::get('/{path}', [
    App\Http\Controllers\HomeController::class,
    'index',
])->where('path', '.*');
