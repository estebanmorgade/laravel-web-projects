<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Api\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApiProjectController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('api.logout');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum')->name('api.me');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/*
Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    if($request->user()->role === 'superadmin')
        return \App\Models\User::all();
    else
        return response()->json(['message' => 'Unauthorized'], 403);
});


Route::post('/users', [UserController::class, 'store'])->middleware('auth:sanctum')->name('api.users.store');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('auth:sanctum')->name('api.users.destroy');
*/

Route::resource('users', UserController::class)
->names('api.users')->parameters(['users' => 'user']);

Route::resource('projects', ApiProjectController::class)
->names('api.projects')->parameters(['projects' => 'project']);
