<?php

use App\DataTables\UsersDataTable;
use App\Helpers\ImageFilter;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Intervention\Image\ImageManagerStatic;
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

Route::get('user/{id}/edit', function($id){
return $id;
})->name('user.edit');

Route::get('user/{id}/delete', function($id){
return $id;
})->name('user.delete');

Route::get('image', function(){
    $img = ImageManagerStatic::make('car.jpg');
    $img->filter(new ImageFilter);
    return $img->response();
});
Route::get('/dashboard', function (UsersDataTable $dataTable) {
  return $dataTable->render('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
