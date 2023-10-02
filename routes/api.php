<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubCategoryDetailController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



// user
Route::prefix("users")->group(function() {

    Route::get("/", [UserController::class, "index"]);
    Route::get("/{id}", [UserController::class, "show"]);
    Route::delete("/{id}", [UserController::class, "destroy"]);
    Route::post("/register", [UserController::class, "register"]);
    Route::post("/login", [UserController::class, "login"]);
    Route::post("/loginApps", [UserController::class, "loginApps"]);
});
Route::post("/forgot-password", [UserController::class, "forgotPassword"]);
Route::post("/reset-password", [UserController::class, "resetPassword"]);

// category
Route::get("/categories", [CategoryController::class, "index"]);
Route::get("/categories/{id}", [CategoryController::class, "show"]);

// sub category
Route::get("/sub-categories/byCategory/{id}", [SubCategoryController::class, "index"]);
Route::get("/sub-categories/{id}", [SubCategoryController::class, "show"]);

Route::get("/sub-category-details/{id}", [SubCategoryDetailController::class, "index"]);

// notif
Route::prefix("notifications")->group(function(){

    Route::get("/user/{id}", [NotificationController::class, "index"]);
    Route::get("/show/{id}", [NotificationController::class, "show"]);
    Route::get("/update/{id}", [NotificationController::class, "update"]);
});


// order
Route::prefix('orders')->group(function(){
    Route::get("/", [OrderController::class, "index"]);
    Route::get("/countByStatus", [OrderController::class, "countByStatus"]);
    Route::get("/export/{id}/{month}", [OrderController::class, "dataExport"]);
    Route::get("/history/getByUser/{id}", [OrderController::class, "showHistoryByUser"]);
    Route::get("/history/{month}", [OrderController::class, "getHistory"]);
    Route::get("getByStatus/{status}", [OrderController::class, "getByStatus"]);
    Route::get("/mobile/{id}", [OrderController::class, "showMobile"]);
    Route::get("/byId/{id}", [OrderController::class, "show"]);
    Route::put("/updateStatus/{id}", [OrderController::class, "update"]);
    Route::get("/ambilBarang/{id}", [OrderController::class, "ambilBarang"]);
    Route::get("/{id}", [OrderController::class, "show"]);
    Route::post("/", [OrderController::class, "store"]);
    Route::delete("/{id}", [OrderController::class, "destroy"]);
});



