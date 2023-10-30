<?php

namespace App\Modules\Invoices\Infrastructure\Persistence\Queries;

use App\Infrastructure\Persistence\PersistenceHandler;
use App\Modules\Invoices\Infrastructure\Persistence\Repositories\InvoiceRepository;

readonly class GetInvoiceDetailsByUuid implements PersistenceHandler
{
    public function __construct(
        private InvoiceRepository $repository,
        private string            $uuid
    )
    {
    }

    public function execute(): array
    {
        $results = $this->repository->getInvoiceDetailsByUuid($this->uuid);
        $groupedResults = [];
        foreach ($results as $result) {
            if (!isset($groupedResults[$result->id])) {
                $groupedResults[$result->id] = [
                    'id' => $result->id,
                    'number' => $result->number,
                    'date' => $result->date,
                    'due_date' => $result->due_date,
                    'seller' => [
                        'id' => $result->seller_id,
                        'name' => $result->seller_name,
                        'street' => $result->seller_street,
                        'city' => $result->seller_city,
                        'zip' => $result->seller_zip,
                        'phone' => $result->seller_phone,
                    ],
                    'buyer' => [
                        'id' => $result->buyer_id,
                        'name' => $result->buyer_name,
                        'street' => $result->buyer_street,
                        'city' => $result->buyer_city,
                        'zip' => $result->buyer_zip,
                        'phone' => $result->buyer_phone,
                        'email' => $result->buyer_email,
                    ],
                ];
                $groupedResults[$result->id]['total_price'] = 0;
            }

            $groupedResults[$result->id]['invoice_lines'][] = [
                'name' => $result->product_name,
                'price' => $result->product_price,
                'currency' => $result->product_currency,
                'quantity' => $result->product_quantity,
            ];
            $groupedResults[$result->id]['total_price'] += $result->product_price * $result->product_quantity;
        }

        return $groupedResults;
    }
}
