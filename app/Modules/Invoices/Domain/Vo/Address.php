<?php

namespace App\Modules\Invoices\Domain\Vo;

readonly class Address
{
    public function __construct(
        private string $street,
        private string $city,
        private string $postalCode
    )
    {
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }
}
