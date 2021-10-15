<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;



// temporarily redirect / route to dashboard
Route::redirect('/', '/admin-panel/dashboard');

Route::get('/admin-panel/dashboard', function () {
    return view('admin.dashboard');
})->name("dashboard");

Route::prefix("admin-panel/management")->name("admin.")->group(function(){

    Route::resource("brands",BrandController::class);
    Route::resource("attributes",AttributeController::class);
    Route::resource("categories",CategoryController::class);
    Route::resource("tags",TagController::class);
});
