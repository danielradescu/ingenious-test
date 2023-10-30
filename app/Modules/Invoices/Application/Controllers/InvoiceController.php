<?php

namespace App\Modules\Invoices\Application\Controllers;

use App\Infrastructure\Controller;
use App\Modules\Invoices\Domain\Dto\InvoiceDto;
use App\Modules\Invoices\Domain\InvoiceService;
use App\Modules\Invoices\Infrastructure\Persistence\Repositories\InvoiceRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;


class InvoiceController extends Controller
{
    public function show(string $invoiceId, InvoiceService $invoiceService, InvoiceRepository $repository): Response|array|Application|ResponseFactory
    {
        $invoice = $invoiceService->buildInvoice($invoiceId);
        if (!$invoice) {
            return response('Invalid data', 422);
        }
        $invoiceDto = new InvoiceDto($invoice);
        return $invoiceDto->toArray();
    }
}
