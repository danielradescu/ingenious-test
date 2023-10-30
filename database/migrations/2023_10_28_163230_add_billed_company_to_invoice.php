<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        return;
        Schema::table('invoices', function (Blueprint $table): void {
            $table->uuid('billed_company_id');
            $table->foreign('billed_company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        return;
        Schema::table('invoices', function (Blueprint $table): void {
            $table->dropForeign('invoices_billed_company_id_foreign');
            $table->dropColumn('billed_company_id');
//            $table->dropConstrainedForeignId('billed_company_id');
        });
    }
};
