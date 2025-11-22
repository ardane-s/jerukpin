<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            // Add type column (bank_transfer, e_wallet, cod, etc.)
            $table->string('type')->default('bank_transfer')->after('id');
            
            // Rename columns to be more generic
            $table->renameColumn('bank_name', 'method_name');
            $table->renameColumn('account_number', 'account_info');
            $table->renameColumn('account_holder', 'account_name');
        });
    }

    public function down(): void
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->renameColumn('method_name', 'bank_name');
            $table->renameColumn('account_info', 'account_number');
            $table->renameColumn('account_name', 'account_holder');
        });
    }
};
