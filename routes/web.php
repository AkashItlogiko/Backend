<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\AdminColorController;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', [AdminController::class, 'login'])->name('admin.login');

Route::post('admin/auth', [AdminController::class, 'auth'])->name('admin.auth');

Route::middleware('admin')->group(function () {
    Route::prefix('admin')->group(function(){
        Route::get('dashboard', [AdminController::class, 'index'])->name('admin.index');
        Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');

        // Colors routes
        Route::resource('colors', AdminColorController::class, [
            'names' => [ // Use 'names' instead of 'name'
                'index' => 'admin.colors.index',
                'create' => 'admin.colors.create',
                'store' => 'admin.colors.store',
                'edit' => 'admin.colors.edit',
                'update' => 'admin.colors.update',
                'destroy' => 'admin.colors.destroy',
            ]
        ]);
        // sizes routes
        Route::resource('sizes', SizeController::class, [
            'names' => [ // Use 'names' instead of 'name'
                'index' => 'admin.sizes.index',
                'create' => 'admin.sizes.create',
                'store' => 'admin.sizes.store',
                'edit' => 'admin.sizes.edit',
                'update' => 'admin.sizes.update',
                'destroy' => 'admin.sizes.destroy',
            ]
        ]);
    });
});
