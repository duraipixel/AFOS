<?php

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

// front end routes
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/online/food', [App\Http\Controllers\OrderController::class, 'index'])->name('online.food');

Route::get('backend/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm' ]);

Auth::routes();
Route::prefix('backend')->middleware(['auth'])->group(function(){

    Route::get('/', [App\Http\Controllers\backend\DashboardController::class, 'index'])->name('dashboard');
    
    Route::prefix('settings')->group(function(){
        Route::get('/', [App\Http\Controllers\backend\SettingController::class, 'index'])->name('settings');
        Route::post('/tabs', [App\Http\Controllers\backend\SettingController::class, 'get_tab'])->name('get-tab');
        Route::post('/account/save', [App\Http\Controllers\backend\SettingController::class, 'account_save'])->name('account.save');
        Route::post('/settings/save', [App\Http\Controllers\backend\SettingController::class, 'settings_save'])->name('settings.save');
        Route::post('/password/save', [App\Http\Controllers\backend\SettingController::class, 'change_password'])->name('password.save');
    });

    Route::prefix('users')->group(function(){
        Route::get('/', [App\Http\Controllers\backend\UserController::class, 'index'])->name('users');
        Route::post('/users/add', [App\Http\Controllers\backend\UserController::class, 'add_edit_modal'])->name('users.add_edit');
        Route::post('/users/save', [App\Http\Controllers\backend\UserController::class, 'save_users'])->name('users.save');
        Route::post('/users/delete', [App\Http\Controllers\backend\UserController::class, 'delete_users'])->name('users.delete');
    });

    Route::prefix('roles')->group(function(){
        Route::get('/', [App\Http\Controllers\backend\RoleController::class, 'index'])->name('roles');
        Route::post('/roles/add', [App\Http\Controllers\backend\RoleController::class, 'add_edit_modal'])->name('roles.add_edit');
        Route::post('/roles/save', [App\Http\Controllers\backend\RoleController::class, 'save_role'])->name('roles.save');
        Route::post('/roles/delete', [App\Http\Controllers\backend\RoleController::class, 'delete_role'])->name('roles.delete');
    });

    Route::prefix('locations')->group(function(){
        Route::get('/', [App\Http\Controllers\backend\LocationController::class, 'index'])->name('locations');
        Route::post('/list', [App\Http\Controllers\backend\LocationController::class, 'ajax_list'])->name('locations.list');
        Route::post('/view', [App\Http\Controllers\backend\LocationController::class, 'view'])->name('locations.view');
        Route::post('/locations/add', [App\Http\Controllers\backend\LocationController::class, 'add_edit_modal'])->name('locations.add_edit');
        Route::post('/locations/save', [App\Http\Controllers\backend\LocationController::class, 'save'])->name('locations.save');
        Route::post('/locations/delete', [App\Http\Controllers\backend\LocationController::class, 'delete'])->name('locations.delete');
    });
    
    Route::prefix('institutes')->group(function(){
        Route::get('/', [App\Http\Controllers\backend\InstituteController::class, 'index'])->name('institutes');
        Route::post('/institutes/add', [App\Http\Controllers\backend\InstituteController::class, 'add_edit_modal'])->name('institutes.add_edit');
        Route::post('/institutes/save', [App\Http\Controllers\backend\InstituteController::class, 'save_role'])->name('institutes.save');
        Route::post('/institutes/delete', [App\Http\Controllers\backend\InstituteController::class, 'delete_role'])->name('institutes.delete');
    });

    Route::prefix('students')->group(function(){
        Route::get('/', [App\Http\Controllers\backend\StudentController::class, 'index'])->name('students');
        Route::get('/imports', [App\Http\Controllers\backend\StudentController::class, 'import_students'])->name('student-imports');
    });

    Route::prefix('product-category')->group(function(){
        Route::get('/', [App\Http\Controllers\backend\ProductCategoryController::class, 'index'])->name('product-category');
        Route::post('/product-category/add', [App\Http\Controllers\backend\ProductCategoryController::class, 'add_edit_modal'])->name('product-category.add_edit');
        Route::post('/product-category/save', [App\Http\Controllers\backend\ProductCategoryController::class, 'save_role'])->name('product-category.save');
        Route::post('/product-category/delete', [App\Http\Controllers\backend\ProductCategoryController::class, 'delete_role'])->name('product-category.delete');
    });

    Route::prefix('products')->group(function(){
        Route::get('/', [App\Http\Controllers\backend\ProductController::class, 'index'])->name('products');
        Route::post('/products/add', [App\Http\Controllers\backend\ProductController::class, 'add_edit_modal'])->name('products.add_edit');
        Route::post('/products/save', [App\Http\Controllers\backend\ProductController::class, 'save_role'])->name('products.save');
        Route::post('/products/delete', [App\Http\Controllers\backend\ProductController::class, 'delete_role'])->name('products.delete');
    });

    Route::prefix('payments')->group(function(){
        Route::get('/', [App\Http\Controllers\backend\PaymentController::class, 'index'])->name('payments');
    });

    Route::prefix('orders')->group(function(){
        Route::get('/', [App\Http\Controllers\backend\OrderController::class, 'index'])->name('orders');
    });

    Route::prefix('reports')->group(function(){
        Route::get('/location/wise', [App\Http\Controllers\backend\ReportController::class, 'location_wise_report'])->name('location-wise-reports');
        Route::get('/class/wise', [App\Http\Controllers\backend\ReportController::class, 'location_wise_report'])->name('class-wise-reports');
        Route::get('/food/type', [App\Http\Controllers\backend\ReportController::class, 'location_wise_report'])->name('food-type-reports');
    });

});


