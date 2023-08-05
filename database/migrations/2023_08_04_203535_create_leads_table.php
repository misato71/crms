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
        Schema::create('leads', function (Blueprint $table) {
            $table->integer('lead_id')->autoIncrement();
            $table->string('lead_name', 50);
            $table->integer('status')->nullable();            
            $table->integer('lead_company')->nullable();            
            $table->timestamp('modified_date')->nullable();
            $table->string('created_id', 20)->nullable();
            $table->string('modified_id', 20)->nullable();

            $table->foreign('lead_company')->references('customer_id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
