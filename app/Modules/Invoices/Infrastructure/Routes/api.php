<?php


use App\Modules\Invoices\Application\Controllers\InvoiceController;
use App\Modules\Invoices\Infrastructure\Routes\ApiMappingEnum;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Invoice API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Invoice API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('{guid}', [InvoiceController::class, 'show'])->name('invoice.show');
