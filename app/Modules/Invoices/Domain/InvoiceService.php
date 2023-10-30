<?php

namespace App\Modules\Invoices\Domain;

use App\Modules\Invoices\Domain\Invoice\Entities\Buyer;
use App\Modules\Invoices\Domain\Invoice\Entities\Seller;
use App\Modules\Invoices\Domain\Invoice\Invoice;
use App\Modules\Invoices\Domain\Invoice\ValueObjects\InvoiceLine;
use App\Modules\Invoices\Domain\Invoice\ValueObjects\InvoiceLines;
use App\Modules\Invoices\Domain\Vo\Address;
use App\Modules\Invoices\Domain\Vo\Date;
use App\Modules\Invoices\Infrastructure\Persistence\Queries\GetInvoiceDetailsByUuid;
use App\Modules\Invoices\Infrastructure\Persistence\Repositories\InvoiceRepository;
use Illuminate\Support\Carbon;
use Ramsey\Uuid\Uuid;

readonly class InvoiceService
{

    public function __construct(private InvoiceRepository $repository)
    {
    }


    public function buildInvoice(string $invoiceId): ?Invoice
    {
        $query = new GetInvoiceDetailsByUuid($this->repository, $invoiceId);
        $invoiceData = $query->execute();

        if (!$invoiceData) {
            return null;
        }

        $buyerAddress = new Address(
            $invoiceData[$invoiceId]['buyer']['street'],
            $invoiceData[$invoiceId]['buyer']['city'],
            $invoiceData[$invoiceId]['buyer']['zip'],
        );


        $buyer = new Buyer(
            $invoiceData[$invoiceId]['buyer']['name'],
            $buyerAddress,
            $invoiceData[$invoiceId]['buyer']['email'],
            $invoiceData[$invoiceId]['buyer']['phone']
        );

        $sellerAddress = new Address(
            $invoiceData[$invoiceId]['seller']['street'],
            $invoiceData[$invoiceId]['seller']['city'],
            $invoiceData[$invoiceId]['seller']['zip'],
        );

        $seller = new Seller(
            $invoiceData[$invoiceId]['seller']['name'],
            $sellerAddress,
            $invoiceData[$invoiceId]['seller']['phone']
        );

        $invoiceLines = new InvoiceLines();

        foreach ($invoiceData[$invoiceId]['invoice_lines'] as $invoiceLine) {
            $invoiceLines = $invoiceLines->add(new InvoiceLine($invoiceLine['name'], $invoiceLine['price'], $invoiceLine['quantity'], $invoiceLine['currency']));
        }



        $carbonDate = Carbon::createFromFormat('Y-m-d', $invoiceData[$invoiceId]['date']);
        $carbonDueDate = Carbon::createFromFormat('Y-m-d', $invoiceData[$invoiceId]['due_date']);

        return new Invoice(
            Uuid::fromString($invoiceData[$invoiceId]['id']),
            Uuid::fromString($invoiceData[$invoiceId]['number']),
            new Date($carbonDate->year, $carbonDate->month, $carbonDate->day),
            new Date($carbonDueDate->year, $carbonDueDate->month, $carbonDueDate->day),
            $seller,
            $buyer,
            $invoiceLines,
            $invoiceData[$invoiceId]['total_price'],
        );
    }
}
