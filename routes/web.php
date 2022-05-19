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
// frontend routes starts
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/online/student', [App\Http\Controllers\OrderController::class, 'index'])->name('online.student');
Route::get('/online/food', [App\Http\Controllers\OrderController::class, 'get_food_info'])->name('online.food');
Route::get('/confirm/order', [App\Http\Controllers\OrderController::class, 'order_info'])->name('confirm.order');
Route::get('/order/confirmation', [App\Http\Controllers\OrderController::class, 'confirmation'])->name('confirmation.order');

Route::post('/check/student', [App\Http\Controllers\OrderController::class, 'check_student'])->name('check.student');
Route::post('/student/list', [App\Http\Controllers\OrderController::class, 'student_list'])->name('student.list');
Route::post('/init/order', [App\Http\Controllers\OrderController::class, 'initialize_order'])->name('order.student.initialize');
Route::post('/change/student', [App\Http\Controllers\OrderController::class, 'change_student'])->name('order.student.change');
Route::post('/select/food', [App\Http\Controllers\OrderController::class, 'select_food'])->name('order.select.food');
Route::post('/delete/food', [App\Http\Controllers\OrderController::class, 'delete_food'])->name('order.delete.food');
Route::post('/food/list', [App\Http\Controllers\OrderController::class, 'order_list'])->name('order.food.list');
Route::post('/food/payment', [App\Http\Controllers\OrderController::class, 'confirm_payment'])->name('confirm.food.payment');
 
// frontend routes ends
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
        Route::post('/users/save', [App\Http\Controllers\backend\UserController::class, 'save'])->name('users.save');
        Route::post('/users/delete', [App\Http\Controllers\backend\UserController::class, 'delete'])->name('users.delete');
    });

    Route::prefix('roles')->group(function(){
        Route::get('/', [App\Http\Controllers\backend\RoleController::class, 'index'])->name('roles');
        Route::post('/roles/add', [App\Http\Controllers\backend\RoleController::class, 'add_edit_modal'])->name('roles.add_edit');
        Route::post('/roles/save', [App\Http\Controllers\backend\RoleController::class, 'save'])->name('roles.save');
        Route::post('/roles/delete', [App\Http\Controllers\backend\RoleController::class, 'delete'])->name('roles.delete');
    });

    Route::prefix('locations')->group(function(){
        Route::get('/', [App\Http\Controllers\backend\LocationController::class, 'index'])->name('locations');
        Route::post('/view', [App\Http\Controllers\backend\LocationController::class, 'view'])->name('locations.view');
        Route::post('/locations/add', [App\Http\Controllers\backend\LocationController::class, 'add_edit_modal'])->name('locations.add_edit');
        Route::post('/locations/save', [App\Http\Controllers\backend\LocationController::class, 'save'])->name('locations.save');
        Route::post('/locations/delete', [App\Http\Controllers\backend\LocationController::class, 'delete'])->name('locations.delete');
    }); 
    
    Route::prefix('institutes')->group(function(){
        Route::get('/', [App\Http\Controllers\backend\InstituteController::class, 'index'])->name('institutes');
        Route::post('/institutes/add', [App\Http\Controllers\backend\InstituteController::class, 'add_edit_modal'])->name('institutes.add_edit');
        Route::post('/institutes/save', [App\Http\Controllers\backend\InstituteController::class, 'save'])->name('institutes.save');
        Route::post('/institutes/delete', [App\Http\Controllers\backend\InstituteController::class, 'delete'])->name('institutes.delete');
    });

    Route::prefix('students')->group(function(){
        Route::get('/', [App\Http\Controllers\backend\StudentController::class, 'index'])->name('students');
        Route::post('/', [App\Http\Controllers\backend\StudentController::class, 'view'])->name('students.view');
        Route::get('/imports', [App\Http\Controllers\backend\StudentController::class, 'import_students'])->name('student-imports');
        Route::post('/excel/imports', [App\Http\Controllers\backend\StudentController::class, 'import'])->name('student.do.imports');
    });

    Route::prefix('product-category')->group(function(){
        Route::get('/', [App\Http\Controllers\backend\ProductCategoryController::class, 'index'])->name('product-category');
        Route::post('/product-category/add', [App\Http\Controllers\backend\ProductCategoryController::class, 'add_edit_modal'])->name('product-category.add_edit');
        Route::post('/product-category/save', [App\Http\Controllers\backend\ProductCategoryController::class, 'save'])->name('product-category.save');
        Route::post('/product-category/delete', [App\Http\Controllers\backend\ProductCategoryController::class, 'delete'])->name('product-category.delete');
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


