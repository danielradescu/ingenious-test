<?php

namespace App\Modules\Invoices\Infrastructure\Tests\Functional;

use App\Modules\Invoices\Infrastructure\Routes\ApiMappingEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use JetBrains\PhpStorm\NoReturn;
use Tests\TestCase;

class InvoiceApiTest extends TestCase
{
    #[NoReturn] public function test_show_invoice_data()
    {
        $invoice = DB::table('invoices')->first('id');
        var_dump($invoice->id);
        $response = Http::get(route('invoice.show', ['guid' => $invoice->id]));
        dd($response->body());
        $this->assertEquals(200, $response->status());
        $this->isJson($response->body());
    }

    #[NoReturn] public function test_invalid_data_show_invoice_data()
    {
        $response = Http::get(route('invoice.show', ['guid' => 'invalid id here']));
        $this->assertEquals(422, $response->status());
    }
}
