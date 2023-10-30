<?php

namespace App\Modules\Invoices\Domain\Dto;

use App\Modules\Invoices\Domain\Invoice\Invoice;
use App\Modules\Invoices\Domain\Vo\Date;

readonly class InvoiceDto
{
    public function __construct(
        private Invoice $invoice,
    )
    {
    }

    public function getNumber(): string
    {
        return $this->invoice->getNumber()->toString();
    }

    private function formatDate(Date $date): string
    {
        return $date->getYear() ."-".$date->getMonth() ."-".$date->getDay();
    }

    public function getDate(): string
    {
        return $this->formatDate($this->invoice->getDate());
    }

    public function getDueDate(): string
    {
        return $this->formatDate($this->invoice->getDueDate());
    }

    public function getInvoiceLines(): array
    {
        $result = [];
        foreach ($this->invoice->getInvoiceLines()->getInvoiceLines() as $invoiceLine) {
            $result[] = [
                'name' => $invoiceLine->getName(),
                'price' => $invoiceLine->getPrice(),
                'quantity' => $invoiceLine->getQuantity(),
                'currency' => $invoiceLine->getCurrency(),
            ];
        }
        return $result;
    }

    public function getSeller(): array
    {
        $seller = $this->invoice->seller;
        $sellerAddress = $seller->getAddress();
        return [
            'name' => $seller->getName(),
            'street' => $sellerAddress->getStreet(),
            'city' => $sellerAddress->getCity(),
            'postalCode' => $sellerAddress->getPostalCode(),
            'phoneNumber' => $seller->getPhone()
        ];
    }

    public function getBuyer(): array
    {
        $buyer = $this->invoice->buyer;
        $buyerAddress = $buyer->getAddress();
        return [
            'name' => $buyer->getName(),
            'street' => $buyerAddress->getStreet(),
            'city' => $buyerAddress->getCity(),
            'postalCode' => $buyerAddress->getPostalCode(),
            'phoneNumber' => $buyer->getPhone(),
            'email' => $buyer->getEmail(),
        ];
    }

    public function getTotalPrice(): float
    {
        return $this->invoice->totalPrice;
    }

    public function toArray(): array
    {
        return [
            'number' => $this->getNumber(),
            'date' => $this->getDate(),
            'dueDate' => $this->getDueDate(),
            'company' => $this->getSeller(),
            'billed_company' => $this->getBuyer(),
            'products' => $this->getInvoiceLines(),
            'totalPrice' => $this->getTotalPrice(),
        ];
    }


}
