<?php

namespace Tests;

use App\Modules\Invoices\Infrastructure\Persistence\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        // Run your seeders here
        $this->seed(DatabaseSeeder::class);
    }
}
