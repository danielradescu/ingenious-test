<?php

namespace App\Modules\Invoices\Domain\Invoice;

use App\Modules\Invoices\Domain\Invoice\Entities\Buyer;
use App\Modules\Invoices\Domain\Invoice\Entities\Seller;
use App\Modules\Invoices\Domain\Invoice\ValueObjects\InvoiceLines;
use App\Modules\Invoices\Domain\Vo\Date;
use Ramsey\Uuid\UuidInterface;

class Invoice
{
    public function __construct(
        public readonly UuidInterface $uuid,
        public readonly UuidInterface $number,
        public Date                   $date,
        public Date                   $dueDate,
        public Seller                 $seller,
        public Buyer                  $buyer,
        public InvoiceLines           $invoiceLines,
        public float                  $totalPrice,
    )
    {
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function getNumber(): UuidInterface
    {
        return $this->number;
    }

    public function getDate(): Date
    {
        return $this->date;
    }

    public function getDueDate(): Date
    {
        return $this->dueDate;
    }

    public function getSeller(): Seller
    {
        return $this->seller;
    }

    public function getBuyer(): Buyer
    {
        return $this->buyer;
    }

    public function getInvoiceLines(): InvoiceLines
    {
        return $this->invoiceLines;
    }
}
