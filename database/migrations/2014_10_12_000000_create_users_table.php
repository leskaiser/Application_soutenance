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
        Schema::disableForeignKeyConstraints();
        Schema::create('wan_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('matricule', 100)->unique();
            $table->integer('parent_id')->nullable()->default(0);
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('position_id');
            $table->foreign('role_id')->references('id')->on('wan_roles')->onDelete('restrict');
            $table->foreign('position_id')->references('id')->on('wan_positions')->onDelete('restrict');
            $table->string('first_name');
            $table->string('last_name');
            $table->timestamp('date_of_birth');
            $table->string('phone_number')->unique();
            $table->string('numero_cni')->unique();
            $table->string('username', 255);
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('ville', 255);
            $table->string('country', 255);
            $table->string('sexe');
            $table->text('motif_suppression')->nullable();
            $table->text('avatar')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('slug', 255)->unique();
            $table->enum('account_status', ['Active', 'Inactive', 'Delete']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
