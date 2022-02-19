<?php

use App\Http\Controllers\Pos\Pos;
// use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Users;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\Product;
use App\Http\Controllers\Setting\Setting;
use App\Http\Controllers\Amenity\Amenitys;
use App\Http\Controllers\Purchase\Purchase;
use App\Http\Controllers\Category\Categorys;
use App\Http\Controllers\Dashboard\Dashboard;
use Laratrust\Http\Controllers\RolesController;
use App\Http\Controllers\Customer\CustomerController;
use Laratrust\Http\Controllers\PermissionsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

require __DIR__.'/auth.php'; #user this class for laravel laratrust Route
# Auth::routes(); user this class for laravel ui Route
Route::group(['middleware'=>['auth'], 'prefix' => 'admin'], function() {

        Route::get('lang/{lang}', [Controller::class ,'switchLang'])->name('lang.switch');


        Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
        Route::get('/user/list', [Users::class, 'index'])->name('user.index');
        Route::get('/user/get/list', [Users::class, 'users_list'])->name('user.list');
        Route::get('/user/profile/{id}', [Users::class, 'profile']);
        Route::get('/user/add', [Users::class, 'create'])->name('create');
        Route::post('user/store', [Users::class, 'store'])->name('store');
        Route::post('user/update/{user_id}', [Users::class, 'update']);
        Route::get('user/{user_id}/edit', [Users::class, 'edit']);
        Route::get('/user/after_change_avatar', [Users::class, 'after_change_avatar'])->name('avatar.after_change_avatar');
        Route::get('/user/avatar_form', [Users::class, 'avatar_modal'])->name('avatar.modal');
        Route::post('/user/update_avatar', [Users::class, 'update_avatar'])->name('avatar.update');
        Route::get('/user/click_delete/', [Users::class, 'click_delete'])->name('user.delete');

        # role
        Route::get('/roles', [RolesController::class, 'role_index'])->name('role.index');
        Route::get('/role/list', [RolesController::class, 'role_list'])->name('role.list');
        Route::get('/role/permissions/{role}/edit', [RolesController::class, 'edit_permission']);
        Route::get('/role/permissions/add', [RolesController::class, 'add_role_permissions'])->name('role.permissions.add');
        Route::get('/role/permissions/delete', [RolesController::class, 'delete_role_permissions'])->name('role.permissions.delete');
        Route::post('/role/permissions/create', [RolesController::class, 'create_role_permissions'])->name('role.permissions.create');
        Route::post('/role/permissions/update_role_permissions/{role}', [RolesController::class, 'update_role_permissions']);
        # permissions
        Route::get('/permissions', [PermissionsController::class, 'permissions_index'])->name('permissions.index');
        Route::get('/permissions/list', [PermissionsController::class, 'permissions_list'])->name('permissions.list');
        Route::get('/permissions/modal/add', [PermissionsController::class, 'permission_modal_add'])->name('permission.modal.add');
        Route::post('/permissions/create', [PermissionsController::class, 'permission_create'])->name('permission.create');
        Route::get('/permissions/modal/edit', [PermissionsController::class, 'permission_modal_edit'])->name('permission.modal.edit');
        Route::post('/permissions/update_permissions', [PermissionsController::class, 'update_permission'])->name('permission.update');

        # Testing relationship with counts Role Permissions Amenity to Group
        Route::get('/amenity', [Amenitys::class, 'index'])->name('amenity');

        # product route
        Route::get('/products', [Product::class, 'index'])->name('product.index');
        Route::get('/products/show', [Product::class, 'show'])->name('product.list');
        Route::get('/product/add', [Product::class, 'add'])->name('product.add');
        Route::post('/product/store', [Product::class, 'store'])->name('product.store');
        Route::get('/product/{id}/edit', [Product::class, 'edit']);
        Route::post('/product/update/{id}/', [Product::class, 'update']);
        Route::get('/product/click_delete/', [Product::class, 'click_delete'])->name('product.delete');
        Route::get('/product/open_modal_add_gallery/', [Product::class, 'modal_add_gallery'])->name('product.modal.add.gallery');
        Route::get('/product/modal_view_product/', [Product::class, 'modal_view_product'])->name('product.modal_view_product');
        Route::post('/product/change_gallery/', [Product::class, 'change_gallery'])->name('product.gallery.change');
        Route::get('/product/checked_delete/', [Product::class, 'checked_delete'])->name('products.checked.delete');
        Route::get('/product/export_excel/', [Product::class, 'export_excel'])->name('product.export_excel');
        Route::get('/product/export_pdf/', [Product::class, 'generatePDF'])->name('product.export_pdf');
        Route::post('/product/actions/', [Product::class, 'actions'])->name('product.actions');

        # category route
        Route::get('/category', [Categorys::class, 'index'])->name('category.index');
        Route::get('/category/show', [Categorys::class, 'show'])->name('category.list');
        Route::get('/category/create', [Categorys::class, 'create'])->name('category.create');
        Route::post('/category/store', [Categorys::class, 'store'])->name('category.store');
        Route::get('/category/{id}/delete', [Categorys::class, 'destroy']);
        Route::get('/category/{id}/edit', [Categorys::class, 'edit']);
        Route::post('/category/update/{id}/', [Categorys::class, 'update']);
        Route::get('/category/checked_delete/', [Categorys::class, 'checked_delete'])->name('categories.checked.delete');

        # purchase
        Route::get('/purchase/add', [Purchase::class, 'create'])->name('purchase.create');
        Route::get('/purchase/store', [Purchase::class, 'store'])->name('purchase.store');
        Route::get('/purchase/suggestions', [Purchase::class, 'suggestions'])->name('purchase.suggestions');


        # POS
        Route::get('/pos/add', [Pos::class, 'create'])->name('pos.create');
        Route::get('/pos/get_product', [Pos::class, 'ajax_get_product'])->name('pos.get_product');
        Route::post('/pos/store', [Pos::class, 'store'])->name('pos.store');
        Route::get('/pos/suggestions', [Pos::class, 'suggestions'])->name('pos.suggestions');
        Route::get('/pos/suggestions_ByClickProduct', [Pos::class, 'suggestions_ByClickProduct'])->name('pos.click_product');
        Route::get('/pos/show_table', [Pos::class, 'show_table'])->name('pos.show.table');



        # Settings settings up
        Route::get('/setting/tables', [Setting::class, 'table_index'])->name('setting.table.index');
        Route::get('/setting/create_table', [Setting::class, 'create_table'])->name('setting.table.create');
        Route::post('/setting/add_table', [Setting::class, 'store_table'])->name('setting.table.store');
        Route::get('/setting/edit_table', [Setting::class, 'edit_table'])->name('setting.table.edit');
        Route::post('/setting/update_table', [Setting::class, 'update_table'])->name('setting.table.update');
        Route::get('/setting/list_table', [Setting::class, 'list_table'])->name('setting.table_list');
        Route::get('/setting/get_table', [Setting::class, 'getTableById'])->name('setting.table.get_table');
        Route::get('/setting/delete_table', [Setting::class, 'deleteTable'])->name('setting.table.delete');

        # customer 
        Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
        Route::get('/customer/show', [CustomerController::class, 'show'])->name('customer.list');
        Route::get('/customer/add', [CustomerController::class, 'create'])->name('customer.add');
        Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
});


