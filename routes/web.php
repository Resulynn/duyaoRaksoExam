<?php

use App\Mail\sendNotif;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CompanyController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/employee', EmployeeController::class);
Route::resource('/company', CompanyController::class);
Route::get('/import', [CompanyController::class, 'import']);

Route::post('/notif',function(){
    $mailData = [
        "name" => Session::get('name'),
    ];

    Mail::to("admin@admin.com")->send(new sendNotif($mailData));
    Session::flash('success', 'Company Added; Email Notification Sent.');
    return redirect('/company');
});
require __DIR__.'/auth.php';
