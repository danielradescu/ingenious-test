<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\Providers;

use App\Modules\Invoices\Domain\InvoiceService;
use App\Modules\Invoices\Infrastructure\Persistence\Repositories\InvoiceRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class InvoiceServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->singleton(InvoiceService::class, function () {
            return new InvoiceService(new InvoiceRepository());
        });
    }
}
