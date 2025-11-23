<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Change enum to string to support 'admin' role
            $table->string('role')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We cannot easily revert to enum without potentially losing data if 'admin' exists
        // So we'll just leave it as string or revert to enum if needed (but risky)
        /*
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['super_admin', 'member'])->default('member')->change();
        });
        */
    }
};
