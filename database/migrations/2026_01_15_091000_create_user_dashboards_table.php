<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('user_dashboards', function (Blueprint $table) {
        $table->id();
        $table->string('name')->nullable();
       $table->foreignId('user_id')->constrained('employees')->onDelete('cascade');
        $table->json('layout'); // غيخزن لينا الترتيب والـ URLs
        $table->text('description')->nullable(); // حقل الوصف الجديد
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_dashboards');
    }
};
