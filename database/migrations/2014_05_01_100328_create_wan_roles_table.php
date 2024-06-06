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
        Schema::create('wan_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role_code')->unique();
            $table->string('role_name')->unique();
            $table->string('role_description')->nullable();
            $table->enum('role_status',['Active', 'Inactive', 'Delete']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wan_roles');
    }
};
