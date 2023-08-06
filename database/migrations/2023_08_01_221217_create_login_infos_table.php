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
        Schema::create('login_infos', function (Blueprint $table) {
            $table->integer('login_id')->autoIncrement();
            $table->string('user_id', 50)->nullable();
            $table->string('staff_password')->nullable();
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
        Schema::dropIfExists('login_infos');
    }
};
