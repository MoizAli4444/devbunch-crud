<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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
    return view('login');
});


Route::post('/login',[EmployeeController::class,'loginp'])->name('employee.login');
Route::get('/logout',[EmployeeController::class,'logout'])->name('log-out');



Route::post('/create',[EmployeeController::class,'create'])->name('employee.create');
Route::get('/view-create',[EmployeeController::class,'viewcreate'])->name('employee.view-create');
Route::get('/view',[EmployeeController::class,'view'])->name('view');
Route::post('/view',[EmployeeController::class,'view'])->name('view');
Route::get('/edit/{id}',[EmployeeController::class,'edit'])->name('employee.edit');  
Route::post('/update/{id}',[EmployeeController::class,'update'])->name('employee.update');  
Route::get('/delete/{id}',[EmployeeController::class,'delete'])->name('employee.delete');  
