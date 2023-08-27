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
        Schema::create('customers', function (Blueprint $table) {
            $table->integer('customer_id')->autoIncrement();
            $table->string('customer_company_name', 50);
            $table->string('customer_manager_name', 50)->nullable();
            $table->string('customer_type',50)->nullable();
            $table->string('customer_email', 100);
            $table->string('customer_phone', 20)->nullable();
            $table->string('customer_address', 200)->nullable();
            $table->integer('our_manager')->nullable();            
            $table->timestamp('modified_date')->nullable();
            $table->string('created_id', 20)->nullable();
            $table->string('modified_id', 20)->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');

    }
};
