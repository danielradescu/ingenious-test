<?php

namespace App\Modules\Invoices\Domain\Vo;

readonly class Date
{
    public function __construct(
        private int $year,
        private int $month,
        private int $day
    )
    {
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getMonth(): int
    {
        return $this->month;
    }

    public function getDay(): int
    {
        return $this->day;
    }
}
