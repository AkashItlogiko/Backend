<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AdminColorController;

Route::get('/', [AdminController::class, 'login'])->name('admin.login');

Route::post('admin/auth', [AdminController::class, 'auth'])->name('admin.auth');

Route::middleware('admin')->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Colors routes
    Route::resource('colors', AdminColorController::class,[
        'name'=>[
           'index'=>'admin.colors.index',
           'create'=>'admin.colors.create',
           'store'=>'admin.colors.store',
           'edit'=>'admin.colors.edit',
           'update'=>'admin.colors.update',
           'destroy'=>'admin.colors.destroy',

        ]
    ]);
});
