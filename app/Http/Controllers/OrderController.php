<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function landing()
    {
        $menus = Menu::where('is_active', true)->orderByDesc('terjual_po')->get();
        $featured = $menus->take(4);

        return view('landing', compact('menus', 'featured'));
    }

    public function menu()
    {
        $menus = Menu::where('is_active', true)->get();

        return view('menu', compact('menus'));
    }

    // Katalog PO untuk Pelanggan/Guest
    public function catalog()
    {
        $menus = Menu::where('is_active', true)->get();

        return view('pelanggan.katalog', compact('menus'));
    }

    public function siswa()
    {
        $student = $this->studentProfile();
        $menus = Menu::where('is_active', true)->get();

        return view('siswa.dashboard', compact('student', 'menus'));
    }

    public function pesananSaya()
    {
        $student = $this->studentProfile();
        $orders = $this->studentOrders($student);
        $riwayat = $orders->map(fn (Order $order): array => $this->orderSummary($order))->all();
        $aktif = $orders->whereIn('status', ['pending', 'accepted', 'ready'])->count();

        return view('siswa.pesanan', compact('student', 'riwayat', 'aktif'));
    }

    public function lacak()
    {
        $student = $this->studentProfile();
        $aktif = $this->studentOrders($student)
            ->whereIn('status', ['pending', 'accepted', 'ready'])
            ->map(fn (Order $order): array => $this->orderSummary($order))
            ->values()
            ->all();

        return view('siswa.lacak', compact('student', 'aktif'));
    }

    public function track(Request $request)
    {
        $validated = $request->validate([
            'kode_trks' => ['required', 'string'],
            'no_whatsapp' => ['required', 'string'],
        ]);
        $order = Order::where('kode_trks', $validated['kode_trks'])
            ->where('no_whatsapp', $validated['no_whatsapp'])
            ->first();

        if (! $order) {
            return back()->with('lacak_error', 'Pesanan tidak ditemukan. Periksa kode dan nomor WhatsApp.');
        }

        return redirect()->route('order.status', $order->id);
    }

    // Submit PO Baru dari Pelanggan
    public function storePo(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string',
            'no_whatsapp' => 'required|string',
            'jam_pengambilan' => 'required|string', //
            'items' => 'required|array',
        ]);

        $subtotal = 0;

        // Cek Kuota PO
        foreach ($request->items as $item) {
            $menu = Menu::findOrFail($item['id']);
            if (($menu->terjual_po + $item['qty']) > $menu->kuota_po) {
                return redirect()->back()->with('error', "Kuota PO untuk {$menu->nama_menu} sudah habis/terbatas!");
            }
            $subtotal += $menu->harga * $item['qty'];
        }

        $biayaAdmin = 1000; // Biaya admin PO +1000[cite: 1, 3]
        $grandTotal = $subtotal + $biayaAdmin;

        $order = Order::create([
            'kode_trks' => 'PO-'.strtoupper(Str::random(6)),
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_whatsapp' => $request->no_whatsapp,
            'tipe_pesanan' => 'pre_order',
            'jam_pengambilan' => $request->jam_pengambilan,
            'catatan' => $request->catatan,
            'subtotal' => $subtotal,
            'biaya_admin' => $biayaAdmin,
            'grand_total' => $grandTotal,
            'status' => 'pending',
        ]);

        foreach ($request->items as $item) {
            $menu = Menu::findOrFail($item['id']);
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $menu->id,
                'harga_satuan' => $menu->harga,
                'qty' => $item['qty'],
                'subtotal' => $menu->harga * $item['qty'],
            ]);

            // Tambah hitungan terjual_po
            $menu->increment('terjual_po', $item['qty']);
        }

        return redirect()->route('order.status', $order->id)->with('success', 'Pesanan PO berhasil dikirim!');
    }

    // Halaman Struk Digital & Status Pesanan
    public function showStatus(string $kode)
    {
        $order = Order::with('orderItems.menu')
            ->where('id', $kode)
            ->orWhere('kode_trks', $kode)
            ->firstOrFail();
        $nomorAntrian = 'A'.str_pad((string) $order->id, 3, '0', STR_PAD_LEFT);
        $dibatalkan = $order->status === 'canceled';
        $statusAktif = in_array($order->status, ['pending', 'accepted', 'ready'], true);
        $statuses = ['pending', 'accepted', 'ready', 'completed'];
        $currentIndex = array_search($order->status, $statuses, true);
        $currentIndex = $currentIndex === false ? 0 : $currentIndex;
        $steps = collect([
            ['label' => 'Pesanan diterima', 'desc' => 'Pesanan masuk ke antrean.', 'status' => 'pending'],
            ['label' => 'Sedang diproses', 'desc' => 'Pesanan sedang disiapkan.', 'status' => 'accepted'],
            ['label' => 'Siap diambil', 'desc' => 'Pesanan siap diambil di counter.', 'status' => 'ready'],
            ['label' => 'Selesai', 'desc' => 'Pesanan sudah selesai.', 'status' => 'completed'],
        ])->map(function (array $step, int $index) use ($currentIndex): array {
            $step['state'] = $index < $currentIndex ? 'done' : ($index === $currentIndex ? 'current' : 'todo');

            return $step;
        })->all();

        return view('pelanggan.status', compact('order', 'nomorAntrian', 'dibatalkan', 'statusAktif', 'steps'));
    }

    // Kelola PO (Admin Dashboard)
    public function adminIndex()
    {
        $orders = Order::with('orderItems.menu')->where('tipe_pesanan', 'pre_order')->latest()->get();
        $kolom = collect(['pending' => 'Menunggu', 'accepted' => 'Diproses', 'ready' => 'Siap Diambil'])
            ->map(fn (string $judul, string $status): array => [
                'status' => $status,
                'judul' => $judul,
                'orders' => $orders->where('status', $status)->map(fn (Order $order): array => $this->adminOrderSummary($order))->values()->all(),
            ])->values()->all();
        $selesai = $orders->whereIn('status', ['completed', 'canceled'])
            ->map(fn (Order $order): array => $this->orderSummary($order))
            ->values()
            ->all();
        $pendingCount = $orders->where('status', 'pending')->count();

        return view('admin.po.index', compact('kolom', 'selesai', 'pendingCount'));
    }

    // Ubah Status PO (Pending -> Accepted -> Ready -> Completed / Canceled)
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->validate(['status' => ['required', 'in:pending,accepted,ready,completed,canceled']])['status'];
        $order->save();

        return redirect()->back()->with('success', 'Status PO berhasil diperbarui!');
    }

    private function studentProfile(): array
    {
        $user = Auth::user();

        return [
            'nama' => $user?->name ?? 'Tamu',
            'kelas' => $user?->kelas ?? '-',
            'nis' => $user?->nis ?? '-',
            'wa' => $user?->no_whatsapp ?? '',
            'inisial' => strtoupper(substr($user?->name ?? 'T', 0, 1)),
        ];
    }

    private function studentOrders(array $student)
    {
        return Order::with('orderItems.menu')
            ->when($student['wa'] !== '', fn ($query) => $query->where('no_whatsapp', $student['wa']))
            ->where('tipe_pesanan', 'pre_order')
            ->latest()
            ->get();
    }

    private function orderSummary(Order $order): array
    {
        return [
            'id' => $order->id,
            'url' => route('order.status', $order->id),
            'antrian' => 'A'.str_pad((string) $order->id, 3, '0', STR_PAD_LEFT),
            'kode' => $order->kode_trks,
            'tanggal' => $order->created_at?->format('d M Y') ?? '-',
            'menu' => $order->orderItems->map(fn (OrderItem $item): string => ($item->menu?->nama_menu ?? 'Menu').' x'.$item->qty)->implode(', '),
            'jadwal' => $order->jam_pengambilan,
            'total' => $order->grand_total,
            'status_label' => ucfirst($order->status),
            'status_class' => $order->status === 'canceled' ? 'bg-red-100 text-red-700' : 'bg-emerald-100 text-emerald-700',
        ];
    }

    private function adminOrderSummary(Order $order): array
    {
        $summary = $this->orderSummary($order);
        $summary['nama'] = $order->nama_pelanggan;
        $summary['nis'] = $order->nis ?? '-';
        $summary['prioritas'] = false;
        $summary['menit'] = $order->created_at?->diffInMinutes(now()) ?? 0;
        $summary['catatan'] = $order->catatan;
        $summary['items'] = $order->orderItems->map(fn (OrderItem $item): array => [
            'nama' => $item->menu?->nama_menu ?? 'Menu',
            'kategori' => $item->menu?->kategori ?? 'lainnya',
            'qty' => $item->qty,
        ])->all();

        return $summary;
    }
}
