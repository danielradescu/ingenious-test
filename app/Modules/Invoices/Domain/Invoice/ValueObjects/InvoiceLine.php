<?php

namespace App\Modules\Invoices\Domain\Invoice\ValueObjects;

readonly class InvoiceLine
{
    public function __construct(
        private string $name,
        private int    $quantity,
        private float  $price,
        private string  $currency
    )
    {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}
