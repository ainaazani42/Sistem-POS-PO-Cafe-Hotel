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
    Schema::create('shifts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained();
        $table->enum('nama_shift', ['shift_1', 'shift_2']);
        $table->date('tanggal');
        $table->integer('saldo_awal')->default(0);
        $table->integer('total_pendapatan')->default(0);
        $table->enum('status_shift', ['open', 'closed'])->default('open');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
