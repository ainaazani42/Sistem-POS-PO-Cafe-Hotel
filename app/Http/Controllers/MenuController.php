<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::latest()->get();
        $stats = [
            'aktif' => $menus->where('is_active', true)->count(),
            'nonaktif' => $menus->where('is_active', false)->count(),
            'total' => $menus->count(),
            'kuota' => $menus->sum('kuota_po'),
            'terjual' => $menus->sum('terjual_po'),
            'habis' => $menus->filter(fn (Menu $menu): bool => $menu->kuota_po - $menu->terjual_po <= 0)->count(),
        ];
        $pendingCount = Order::where('status', 'pending')->count();

        return view('admin.menu.index', compact('menus', 'stats', 'pendingCount'));
    }

    // buat nyimpen menur baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori' => 'required|in:makanan,minuman,snack',
            'harga' => 'required|numeric|min:0',
            'kuota_po' => 'required|numeric|min:0',
            'maks_per_order' => 'required|integer|min:1',
        ]);

        Menu::create([
            ...$validated,
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan!');
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori' => 'required|in:makanan,minuman,snack',
            'harga' => 'required|numeric|min:0',
            'kuota_po' => 'required|numeric|min:0',
            'maks_per_order' => 'required|integer|min:1',
        ]);

        Menu::findOrFail($id)->update($validated);

        return redirect()->back()->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy(int $id)
    {
        Menu::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Menu berhasil dihapus!');
    }

    public function toggleActive($id) // mengubah status aktif/non otomatis
    {
        $menu = Menu::findOrFail($id);
        $menu->is_active = ! $menu->is_active;
        $menu->save();

        return redirect()->back()->with('success', 'Status aktif menu berhasil diperbarui!');
    }

    // baut update batas kouta po
    public function updateQuota(Request $request, $id)
    {
        $request->validate(['kuota_po' => 'required|numeric|min:0']);

        $menu = Menu::findOrFail($id);
        $menu->kuota_po = $request->kuota_po;
        $menu->save();

        return redirect()->back()->with('success', 'Kuo ta PO berhasil diperbarui!');
    }
}
