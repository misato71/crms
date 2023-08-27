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
        Schema::create('staff', function (Blueprint $table) {
            $table->integer('staff_id')->autoIncrement();
            $table->string('staff_name', 50);
            $table->string('staff_email', 50);
            $table->string('staff_phone', 20)->nullable();
            $table->string('staff_department', 50)->nullable();
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
        Schema::dropIfExists('staff');
    }
};
