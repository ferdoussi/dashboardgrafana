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
    Schema::table('panels', function (Blueprint $table) {
        // إضافة العمود بعد خانة الـ id
        // نستخدم unsignedBigInteger لأنه المعيار لـ IDs في لارافيل
        $table->unsignedBigInteger('client_id')->nullable()->after('id');

        // إذا كنت تملك جدول اسمه clients، يفضل إضافة foreign key لضمان سلامة البيانات
        // $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('panels', function (Blueprint $table) {
        $table->dropColumn('client_id');
    });
}
};
