<?php

use App\Http\Controllers\ApiController;
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

Route::get(uri: 'module/{module_name}', action: [ApiController::class, 'index']);
Route::get(uri: 'module/{module_name}/{id}', action: [ApiController::class, 'getById']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
