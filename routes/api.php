<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ChecklistController;
use App\Http\Controllers\API\ChecklistItemController;

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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('checklist', [ChecklistController::class, 'index']);
    Route::post('checklist', [ChecklistController::class, 'store']);
    Route::delete('checklist/{checklist}', [ChecklistController::class, 'destroy']);

    Route::get('checklist/{checklist}/item', [ChecklistItemController::class, 'index']);
    Route::post('checklist/{checklist}/item', [ChecklistItemController::class, 'store']);
    Route::get('checklist/{checklist}/item/{item}', [ChecklistItemController::class, 'show']);
    Route::put('checklist/{checklist}/item/{item}', [ChecklistItemController::class, 'update']);
    Route::delete('checklist/{checklist}/item/{item}', [ChecklistItemController::class, 'destroy']);
    Route::put('checklist/{checklist}/item/rename/{item}', [ChecklistItemController::class, 'rename']);
});
