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
        Schema::create('panels', function (Blueprint $table) {
    $table->id();

    // اسم panel لي غادي يبان ل user
    $table->string('name');
   $table->string('module');
    // URL ديال Grafana iframe
    $table->text('grafana_url');
    // تصنيف (اختياري)
    $table->string('category')->nullable();

    // واش panel خدام ولا مخبي
    $table->boolean('active')->default(true);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panels');
    }
};
