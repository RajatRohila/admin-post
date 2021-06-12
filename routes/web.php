<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminUser;
use App\Http\Controllers\userCategory;

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
    session()->forget("user_id");
    return view('login');
});

Route::post("/checkLogin", [adminUser::class, "verifyUser"]);
Route::get("/signUp", [adminUser::class, "signUp"]);
Route::get("/signUp/{userId}", [adminUser::class, "signUp"]);
Route::post("/insertUser", [adminUser::class, "insertUser"]);
Route::get("/getUsers", [adminUser::class, "getUsers"]);
Route::get("/deleteUser/{userId}", [adminUser::class, "deleteUsers"]);
Route::get("/editUser/{userId}", [adminUser::class, "editUsers"]);
Route::get("/viewCategory", [userCategory::class, "viewCategory"]);
Route::get("/addCategory", [userCategory::class, "addCategory"]);
Route::post("/insertCategory", [userCategory::class, "insertCategory"]);
Route::get("/addCategory/{categoryId}", [userCategory::class, "addCategory"]);
Route::get("/deleteCategory/{categoryId}", [userCategory::class, "deleteCategory"]);