<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('menus', 'nama-menu') && ! Schema::hasColumn('menus', 'nama_menu')) {
            Schema::table('menus', function (Blueprint $table): void {
                $table->renameColumn('nama-menu', 'nama_menu');
            });
        }

        Schema::table('menus', function (Blueprint $table): void {
            if (! Schema::hasColumn('menus', 'maks_per_order')) {
                $table->unsignedInteger('maks_per_order')->default(5)->after('kuota_po');
            }
        });

        Schema::table('orders', function (Blueprint $table): void {
            if (! Schema::hasColumn('orders', 'kode_trks')) {
                $table->string('kode_trks')->nullable()->unique();
            }
            if (! Schema::hasColumn('orders', 'nama_pelanggan')) {
                $table->string('nama_pelanggan')->nullable();
            }
            if (! Schema::hasColumn('orders', 'no_whatsapp')) {
                $table->string('no_whatsapp')->nullable();
            }
            if (! Schema::hasColumn('orders', 'tipe_pesanan')) {
                $table->string('tipe_pesanan')->default('pre_order');
            }
            if (! Schema::hasColumn('orders', 'jam_pengambilan')) {
                $table->string('jam_pengambilan')->nullable();
            }
            if (! Schema::hasColumn('orders', 'catatan')) {
                $table->text('catatan')->nullable();
            }
            if (! Schema::hasColumn('orders', 'subtotal')) {
                $table->unsignedInteger('subtotal')->default(0);
            }
            if (! Schema::hasColumn('orders', 'biaya_admin')) {
                $table->unsignedInteger('biaya_admin')->default(0);
            }
            if (! Schema::hasColumn('orders', 'grand_total')) {
                $table->unsignedInteger('grand_total')->default(0);
            }
            if (! Schema::hasColumn('orders', 'status')) {
                $table->string('status')->default('pending');
            }
        });

        Schema::table('orderitems', function (Blueprint $table): void {
            if (! Schema::hasColumn('orderitems', 'order_id')) {
                $table->unsignedBigInteger('order_id')->nullable();
            }
            if (! Schema::hasColumn('orderitems', 'menu_id')) {
                $table->unsignedBigInteger('menu_id')->nullable();
            }
            if (! Schema::hasColumn('orderitems', 'harga_satuan')) {
                $table->unsignedInteger('harga_satuan')->default(0);
            }
            if (! Schema::hasColumn('orderitems', 'qty')) {
                $table->unsignedInteger('qty')->default(1);
            }
            if (! Schema::hasColumn('orderitems', 'subtotal')) {
                $table->unsignedInteger('subtotal')->default(0);
            }
        });
    }

    public function down(): void
    {
        Schema::table('orderitems', function (Blueprint $table): void {
            foreach (['order_id', 'menu_id', 'harga_satuan', 'qty', 'subtotal'] as $column) {
                if (Schema::hasColumn('orderitems', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        Schema::table('orders', function (Blueprint $table): void {
            foreach (['kode_trks', 'nama_pelanggan', 'no_whatsapp', 'tipe_pesanan', 'jam_pengambilan', 'catatan', 'subtotal', 'biaya_admin', 'grand_total', 'status'] as $column) {
                if (Schema::hasColumn('orders', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        Schema::table('menus', function (Blueprint $table): void {
            if (Schema::hasColumn('menus', 'maks_per_order')) {
                $table->dropColumn('maks_per_order');
            }
            if (Schema::hasColumn('menus', 'nama_menu')) {
                $table->renameColumn('nama_menu', 'nama-menu');
            }
        });
    }
};
