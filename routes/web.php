<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersmController;
use App\Http\Controllers\DashboardController;
  
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
  
Auth::routes();
 

/*------------------------------------------
--------------------------------------------
All Logged Users Routes List
--------------------------------------------
--------------------------------------------*/

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});


/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {
  
    
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
 
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('usersm', [UsersmController::class, 'index'])->name('usersm');
    Route::get('usersm/list', [UsersmController::class, 'getUsersm'])->name('usersm.list');
    Route::post('store-user', [UsersmController::class, 'store']);
    Route::post('delete-user', [UsersmController::class, 'destroy']);
    Route::post('edit-usersm', [UsersmController::class, 'edit']);
    Route::post('save-profile', [UsersmController::class, 'saveprofile']);
});
  
