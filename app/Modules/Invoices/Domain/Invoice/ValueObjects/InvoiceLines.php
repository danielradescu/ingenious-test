<?php

namespace App\Modules\Invoices\Domain\Invoice\ValueObjects;

class InvoiceLines
{
    private array $invoiceLines;

    public function __construct(array $invoiceLines = [])
    {
        // Ensure the provided array consists of InvoiceLine objects
        foreach ($invoiceLines as $invoiceLine) {
            if (!$invoiceLine instanceof InvoiceLine) {
                throw new \InvalidArgumentException('Only InvoiceLine objects can be added to InvoiceLines.');
            }
        }

        $this->invoiceLines = $invoiceLines;
    }

    public function add(InvoiceLine $invoiceLine): InvoiceLines
    {
        $newInvoiceLines = $this->invoiceLines;
        $newInvoiceLines[] = $invoiceLine;
        return new self($newInvoiceLines);
    }

    public function getInvoiceLines(): array
    {
        return $this->invoiceLines;
    }
}
