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
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // Clé primaire (ID) auto-incrémentée
            $table->string('name');
            $table->string('email')->unique(); // Email (unique)
            $table->string('company');
            $table->string('password');
            $table->string('departement');     // Département
            $table->string('role')->default('user');
            $table->timestamps(); // Champs 'created_at' et 'updated_at' automatiques
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
