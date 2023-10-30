<?php

namespace App\Modules\Invoices\Infrastructure\Persistence\Repositories;

use App\Infrastructure\Persistence\QueryRepository;
use Illuminate\Support\Facades\DB;

class InvoiceRepository extends QueryRepository
{
    public function getInvoiceDetailsByUuid(string $uuid): ?object
    {
        return DB::connection($this->getConnection())
            ->table('invoices as i')
            ->join('companies as s', 'i.company_id', '=', 's.id')
            ->join('companies as b', 'i.billed_company_id', '=', 'b.id')
            ->join('invoice_product_lines as ipl', 'ipl.invoice_id', '=', 'i.id')
            ->join('products as p', 'ipl.product_id', '=', 'p.id')
            ->where('i.id', $uuid)
            ->select(
                'i.id', 'i.number', 'i.date', 'i.due_date',
                's.id as seller_id',
                's.name as seller_name',
                's.street as seller_street',
                's.city as seller_city',
                's.zip as seller_zip',
                's.phone as seller_phone',
                'b.id as buyer_id',
                'b.name as buyer_name',
                'b.street as buyer_street',
                'b.city as buyer_city',
                'b.zip as buyer_zip',
                'b.phone as buyer_phone',
                'b.email as buyer_email',
                'p.name as product_name',
                'p.price as product_price',
                'p.currency as product_currency',
                'ipl.quantity as product_quantity'
            )
            ->get();
    }
}
