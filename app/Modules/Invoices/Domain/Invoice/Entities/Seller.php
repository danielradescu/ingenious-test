<?php

namespace App\Modules\Invoices\Domain\Invoice\Entities;

use App\Modules\Invoices\Domain\Vo\Address;

readonly class Seller
{
    public function __construct(
        private string  $name,
        private Address $address,
        private string  $phone
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}
