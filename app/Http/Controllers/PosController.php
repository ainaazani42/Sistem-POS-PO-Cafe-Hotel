<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PosController extends Controller
{
    public function index()
    {
        // mengmbil menu yang diset Aktif sama Admin hari ini
        $menus = Menu::where('is_active', true)->get();

        return view('kasir.pos', compact('menus'));
    }

    public function store(Request $request) // menyaring data yang ingin di kirim
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:menus,id',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        // mengecek kasir yg aktif
        $activeShift = Shift::where('status_shift', 'open')->first();
        $subtotal = 0;
        foreach ($request->items as $item) {
            $menu = Menu::find($item['id']);
            $subtotal += $menu->harga * $item['qty'];
        }

        $order = Order::create([
            'kode_trks' => 'TRX-'.strtoupper(Str::random(6)),
            'user_id' => Auth::id(),
            'nama_pelanggan' => $request->nama_pelanggan,
            'tipe_pesanan' => 'pos_live',
            'subtotal' => $subtotal,
            'biaya_admin' => 0, // POS Kasir langsung tanpa biaya admin PO
            'grand_total' => $subtotal,
            'status' => 'completed',
            'shift_id' => $activeShift ? $activeShift->id : null,
        ]);

        foreach ($request->items as $item) {
            $menu = Menu::find($item['id']);
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $menu->id,
                'harga_satuan' => $menu->harga,
                'qty' => $item['qty'],
                'subtotal' => $menu->harga * $item['qty'],
            ]);
        }

        // Update pendapatan shift
        if ($activeShift) {
            $activeShift->increment('total_pendapatan', $subtotal);
        }

        return response()->json([
            'success' => true,
            'message' => 'Transaksi kasir berhasil disimpan!',
            'order_id' => $order->id,
        ]);
    }
}
