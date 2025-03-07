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
        Schema::create('wan_services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service_code')->unique();
            $table->string('service_name')->unique();
            $table->string('service_description')->nullable();
            $table->enum('service_status', ['Active', 'Inactive', 'Delete']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
