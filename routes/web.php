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

/* CLIENT */
Route::get('/client', [ClientController::class, 'index'])->name('clientindex');
//create
Route::get('/client/create', [ClientController::class, 'create'])->name(
    'clientcreate'
);
//store
Route::post('/client', [ClientController::class, 'store']);
//show
Route::get('/client/{id}/show', [ClientController::class, 'show'])->name(
    'clientshow'
);
//edit
Route::get('/client/{id}/edit', [ClientController::class, 'edit'])->name(
    'clientedit'
);
//update
Route::put('/client/{id}', [ClientController::class, 'update']);
//destroy
Route::delete('/client/{id}', [ClientController::class, 'destroy']);

/* EXPENSE */
Route::get('/expense', [ExpenseController::class, 'index'])->name(
    'expenseindex'
);
//create
Route::get('/expense/create', [ExpenseController::class, 'create'])->name(
    'expensecreate'
);
//store
Route::post('/expense', [ExpenseController::class, 'store']);
//show
Route::get('/expense/{id}/show', [ExpenseController::class, 'show'])->name(
    'expenseshow'
);
//edit
Route::get('/expense/{id}/edit', [ExpenseController::class, 'edit'])->name(
    'expenseedit'
);
//update
Route::put('/expense/{id}', [ExpenseController::class, 'update']);
//destroy
Route::delete('/expense/{id}', [ExpenseController::class, 'destroy']);

/* INVOICE */
Route::get('/invoice', [InvoiceController::class, 'index'])->name(
    'invoiceindex'
);
//create
Route::get('/invoice/create', [InvoiceController::class, 'create'])->name(
    'invoicecreate'
);
//store
Route::post('/invoice', [InvoiceController::class, 'store']);
//show
Route::get('/invoice/{id}/show', [InvoiceController::class, 'show'])->name(
    'invoiceshow'
);
//edit
Route::get('/invoice/{id}/edit', [InvoiceController::class, 'edit'])->name(
    'invoiceedit'
);
//update
Route::put('/invoice/{id}', [InvoiceController::class, 'update']);
//destroy
Route::delete('/invoice/{id}', [InvoiceController::class, 'destroy']);

// /* ISSUE */
// // Route::get('/issue', [IssueController::class, 'index'])->name('issueindex');
// //create
// Route::get('/issue/create', [IssueController::class, 'create'])->name(
//     'issuecreate'
// );
// //store
// Route::post('/issue', [IssueController::class, 'store']);
// //show
// Route::get('/issue/{id}/show', [IssueController::class, 'show'])->name(
//     'issueshow'
// );
// //edit
// Route::get('/issue/{id}/edit', [IssueController::class, 'edit'])->name(
//     'issueedit'
// );
// //update
// Route::put('/issue/{id}', [IssueController::class, 'update']);
// //destroy
// Route::delete('/issue/{id}', [IssueController::class, 'destroy']);
// //import
// Route::post('/issue/import', [IssueController::class, 'import'])->name(
//     'import'
// );

/* NOTE */
Route::get('/note', [NoteController::class, 'index'])->name('noteindex');
//create
Route::get('/note/create', [NoteController::class, 'create'])->name(
    'notecreate'
);
//store
Route::post('/note', [NoteController::class, 'store']);
//show
Route::get('/note/{id}/show', [NoteController::class, 'show'])->name(
    'noteshow'
);
//edit
Route::get('/note/{id}/edit', [NoteController::class, 'edit'])->name(
    'noteedit'
);
//update
Route::put('/note/{id}', [NoteController::class, 'update']);
//destroy
Route::delete('/note/{id}', [NoteController::class, 'destroy']);

/* PAYMENT */
Route::get('/payment', [PaymentController::class, 'index'])->name(
    'paymentindex'
);
//create
Route::get('/payment/create', [PaymentController::class, 'create'])->name(
    'paymentcreate'
);
//store
Route::post('/payment', [PaymentController::class, 'store']);
//show
Route::get('/payment/{id}/show', [PaymentController::class, 'show'])->name(
    'paymentshow'
);
//edit
Route::get('/payment/{id}/edit', [PaymentController::class, 'edit'])->name(
    'paymentedit'
);
//update
Route::put('/payment/{id}', [PaymentController::class, 'update']);
//destroy
Route::delete('/payment/{id}', [PaymentController::class, 'destroy']);

/* PERMISSION */
Route::get('/permission', [PermissionController::class, 'index'])->name(
    'permissionindex'
);
//create
Route::get('/permission/create', [PermissionController::class, 'create'])->name(
    'permissioncreate'
);
//store
Route::post('/permission', [PermissionController::class, 'store']);
//show
Route::get('/permission/{id}/show', [
    PermissionController::class,
    'show',
])->name('permissionshow');
//edit
Route::get('/permission/{id}/edit', [
    PermissionController::class,
    'edit',
])->name('permissionedit');
//update
Route::put('/permission/{id}', [PermissionController::class, 'update']);
//destroy
Route::delete('/permission/{id}', [PermissionController::class, 'destroy']);

// /* PROJECT */
// Route::get('/project', [ProjectController::class, 'index'])->name(
//     'projectindex'
// );
// //create
// Route::get('/project/create', [ProjectController::class, 'create'])->name(
//     'projectcreate'
// );
// //store
// Route::post('/project', [ProjectController::class, 'store']);
// //show
// Route::get('/project/{id}/show', [ProjectController::class, 'show'])->name(
//     'projectshow'
// );
// //edit
// Route::get('/project/{id}/edit', [ProjectController::class, 'edit'])->name(
//     'projectedit'
// );
// //update
// Route::put('/project/{id}', [ProjectController::class, 'update']);
// //destroy
// Route::delete('/project/{id}', [ProjectController::class, 'destroy']);
// //import
// Route::post('/project/import', [ProjectController::class, 'import'])->name(
//     'import'
// );

/* ROLE */
Route::get('/role', [RoleController::class, 'index'])->name('roleindex');
//create
Route::get('/role/create', [RoleController::class, 'create'])->name(
    'rolecreate'
);
//store
Route::post('/role', [RoleController::class, 'store']);
//show
Route::get('/role/{id}/show', [RoleController::class, 'show'])->name(
    'roleshow'
);
//edit
Route::get('/role/{id}/edit', [RoleController::class, 'edit'])->name(
    'roleedit'
);
//update
Route::put('/role/{id}', [RoleController::class, 'update']);
//destroy
Route::delete('/role/{id}', [RoleController::class, 'destroy']);

// /* TASK */
// Route::get('/task', [TaskController::class, 'index'])->name('taskindex');
// //create
// Route::get('/task/create', [TaskController::class, 'create'])->name(
//     'taskcreate'
// );
// //store
// Route::post('/task', [TaskController::class, 'store']);
// //show
// Route::get('/task/{id}/show', [TaskController::class, 'show'])->name(
//     'taskshow'
// );
// //edit
// Route::get('/task/{id}/edit', [TaskController::class, 'edit'])->name(
//     'taskedit'
// );
// //update
// Route::put('/task/{id}', [TaskController::class, 'update']);
// //destroy
// Route::delete('/task/{id}', [TaskController::class, 'destroy']);

/* USER */
Route::get('/user', [UserController::class, 'index'])->name('userindex');
//create
Route::get('/user/create', [UserController::class, 'create'])->name(
    'usercreate'
);
//store
Route::post('/user', [UserController::class, 'store']);
//show
Route::get('/user/{id}/show', [UserController::class, 'show'])->name(
    'usershow'
);
//edit
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name(
    'useredit'
);
//update
Route::put('/user/{id}', [UserController::class, 'update']);
//destroy
Route::delete('/user/{id}', [UserController::class, 'destroy']);

/* VENDOR */
Route::get('/vendor', [VendorController::class, 'index'])->name('vendorindex');
//create
Route::get('/vendor/create', [VendorController::class, 'create'])->name(
    'vendorcreate'
);
//store
Route::post('/vendor', [VendorController::class, 'store']);
//show
Route::get('/vendor/{id}/show', [VendorController::class, 'show'])->name(
    'vendorshow'
);
//edit
Route::get('/vendor/{id}/edit', [VendorController::class, 'edit'])->name(
    'vendoredit'
);
//update
Route::put('/vendor/{id}', [VendorController::class, 'update']);
//destroy
Route::delete('/vendor/{id}', [VendorController::class, 'destroy']);

Auth::routes();

Route::get('/home', [
    App\Http\Controllers\HomeController::class,
    'index',
])->name('home');

Route::get('/{path}', [
    App\Http\Controllers\HomeController::class,
    'index',
])->where('path', '.*');

Auth::routes();
