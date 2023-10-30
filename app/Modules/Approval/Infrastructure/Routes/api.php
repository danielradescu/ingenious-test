<?php

use App\Modules\Approval\Application\Controllers\ApproveController;
use App\Modules\Approval\Application\Controllers\RejectController;
use App\Modules\Approval\Infrastructure\Routes\ApiMappingEnum;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Approval API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Approval API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::patch('/approve', [ApproveController::class, 'update']);
Route::patch('/reject', [RejectController::class, 'update']);
