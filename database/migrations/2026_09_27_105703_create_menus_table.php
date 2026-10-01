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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('nama-menu');
            $table->enum('kategori', ['makanan', 'minuman', 'snack']);
            $table->integer('harga');
            $table->boolean('is_active')->default(true);
            $table->integer('kuota_po')->default(0);
            $table->integer('terjual_po')->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
