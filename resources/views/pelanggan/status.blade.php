<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomor Antrian {{ $nomorAntrian }} - Wikrama Cafe Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        /* lubang tiket di sisi kiri-kanan garis putus-putus */
        .notch::before, .notch::after { content: ''; position: absolute; top: -12px; width: 24px; height: 24px; border-radius: 9999px; background: #f8fafc; }
        .notch::before { left: -12px; }
        .notch::after { right: -12px; }
        @media print { body { background: #fff; } .notch::before, .notch::after { background: #fff; } }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

    <header class="bg-white border-b border-slate-100 print:hidden">
        <div class="max-w-lg mx-auto px-4 h-14 flex items-center justify-between">
            <a href="{{ route('landing') }}" class="flex items-center gap-2.5">
                <span class="w-8 h-8 bg-[#700028] text-white rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 3v7a2 2 0 002 2v9M10 3v7M8 3v7M18 21V3c-2 2-3 5-3 8h3"/></svg>
                </span>
                <span class="font-bold text-sm text-slate-900">Wikrama Cafe Hotel</span>
            </a>
            <a href="{{ route('landing') }}" class="text-xs font-bold text-[#700028]">Beranda</a>
        </div>
    </header>

    <main class="max-w-lg mx-auto px-4 py-6 pb-12 space-y-5">

        <!-- Judul -->
        @if ($dibatalkan)
            <div class="text-center">
                <div class="w-16 h-16 mx-auto rounded-full bg-red-100 text-red-600 flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" d="M6 6l12 12M18 6L6 18"/></svg>
                </div>
                <h1 class="text-xl font-extrabold text-slate-900 mt-4">Pesanan Dibatalkan</h1>
                <p class="text-sm text-slate-500 mt-1">Pesanan ini dibatalkan. Hubungi kasir bila ada pertanyaan.</p>
            </div>
        @endif
        @if (! $dibatalkan)
            <div class="text-center">
                <div class="w-16 h-16 mx-auto rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                </div>
                <h1 class="text-xl font-extrabold text-slate-900 mt-4">Pre-Order Berhasil!</h1>
                <p class="text-sm text-slate-500 mt-1">Tunjukkan nomor antrian ini di counter saat mengambil pesanan.</p>
            </div>
        @endif

        <!-- Tiket nomor antrian -->
        <section class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden {{ $dibatalkan ? 'opacity-60' : '' }}">
            <div class="bg-gradient-to-br from-[#700028] to-[#4a0019] text-white text-center px-6 pt-7 pb-8">
                <p class="text-[11px] font-bold tracking-[0.2em] text-white/70">NOMOR ANTRIAN</p>
                <p class="text-6xl sm:text-7xl font-extrabold tracking-tight mt-2">{{ $nomorAntrian }}</p>
                <span class="inline-flex items-center gap-2 mt-4 bg-white/15 rounded-full px-4 py-1.5 text-xs font-semibold">
                    🕘 {{ $order->jam_pengambilan }}
                </span>
            </div>

            <div class="notch relative border-t-2 border-dashed border-slate-200"></div>

            <div class="px-6 py-5 space-y-3.5 text-sm">
                <div class="flex items-center justify-between gap-3">
                    <div class="min-w-0">
                        <p class="text-[11px] text-slate-500">Kode Transaksi</p>
                        <p id="kodeTrx" class="font-extrabold text-slate-900 tracking-wide">{{ $order->kode_trks }}</p>
                    </div>
                    <button id="copyBtn" type="button" class="print:hidden shrink-0 text-xs font-bold text-[#700028] bg-pink-50 hover:bg-pink-100 px-3 py-2 rounded-lg transition">Salin</button>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div><p class="text-[11px] text-slate-500">Nama</p><p class="font-bold text-slate-900 break-words">{{ $order->nama_pelanggan }}</p></div>
                    <div><p class="text-[11px] text-slate-500">NIS</p><p class="font-bold text-slate-900">{{ $order->nis }}</p></div>
                    <div class="col-span-2"><p class="text-[11px] text-slate-500">WhatsApp</p><p class="font-bold text-slate-900">{{ $order->no_whatsapp }}</p></div>
                </div>
                <div><p class="text-[11px] text-slate-500">Dipesan pada</p><p class="font-bold text-slate-900">{{ $order->created_at->format('d M Y, H:i') }} WIB</p></div>
            </div>
        </section>

        <!-- Status -->
        <section class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <h2 class="text-sm font-extrabold text-slate-900 mb-4">Status Pesanan</h2>
            <ol class="space-y-0">
                @foreach ($steps as $i => $step)
                    <li class="flex gap-3">
                        <div class="flex flex-col items-center">
                            <span class="w-7 h-7 shrink-0 rounded-full flex items-center justify-center text-xs font-bold {{ $step['state'] === 'done' ? 'bg-emerald-500 text-white' : ($step['state'] === 'current' ? 'bg-[#700028] text-white ring-4 ring-pink-100' : 'bg-slate-100 text-slate-400') }}">{{ $step['state'] === 'done' ? '✓' : $i + 1 }}</span>
                            <span class="w-0.5 flex-1 min-h-[20px] {{ $step['state'] === 'done' ? 'bg-emerald-300' : 'bg-slate-200' }}"></span>
                        </div>
                        <div class="pb-5 -mt-0.5">
                            <p class="text-sm font-bold {{ $step['state'] === 'todo' ? 'text-slate-400' : 'text-slate-900' }}">{{ $step['label'] }}</p>
                            <p class="text-xs {{ $step['state'] === 'todo' ? 'text-slate-300' : 'text-slate-500' }}">{{ $step['desc'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ol>
            @if ($statusAktif)
                <p class="text-[11px] text-slate-400 -mt-2">Halaman ini diperbarui otomatis tiap 30 detik.</p>
            @endif
        </section>

        <!-- Rincian -->
        <section class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <h2 class="text-sm font-extrabold text-slate-900 mb-3">Rincian Pesanan</h2>
            <ul class="divide-y divide-slate-100 text-sm">
                @foreach ($order->orderItems as $item)
                    <li class="py-2.5 flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <p class="font-semibold text-slate-900">{{ $item->menu->nama_menu }}</p>
                            <p class="text-xs text-slate-500">{{ $item->qty }} × Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</p>
                        </div>
                        <p class="font-bold text-slate-900 shrink-0">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                    </li>
                @endforeach
            </ul>
            <dl class="mt-3 pt-3 border-t border-dashed border-slate-200 text-sm space-y-1.5">
                <div class="flex justify-between text-slate-600"><dt>Subtotal</dt><dd class="font-semibold text-slate-800">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</dd></div>
                <div class="flex justify-between text-slate-600"><dt>Biaya admin PO</dt><dd class="font-semibold text-slate-800">Rp {{ number_format($order->biaya_admin, 0, ',', '.') }}</dd></div>
                <div class="flex justify-between text-base font-extrabold text-slate-900 pt-1"><dt>Total Bayar</dt><dd class="text-[#700028]">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</dd></div>
            </dl>
            @if ($order->catatan)
                <p class="mt-4 text-xs text-slate-600 bg-slate-50 rounded-xl px-3 py-2.5"><span class="font-bold">Catatan:</span> {{ $order->catatan }}</p>
            @endif
        </section>

        <!-- Info pengambilan -->
        <section class="bg-orange-50 border border-orange-100 rounded-2xl p-5 text-xs text-slate-700 leading-relaxed space-y-2">
            <p class="font-extrabold text-sm text-orange-700">Cara Pengambilan</p>
            <p>📍 Counter Cafe Wikrama, Gedung Teaching Factory Lantai 1 (samping Lobi Edotel).</p>
            <p>🎫 Tunjukkan nomor antrian <b>{{ $nomorAntrian }}</b> atau kode <b>{{ $order->kode_trks }}</b> ke petugas.</p>
            <p>💵 Bayar <b>tunai</b> sebesar <b>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</b> di kasir saat pesanan diserahkan.</p>
        </section>

        <!-- Aksi -->
        <div class="grid grid-cols-2 gap-3 print:hidden">
            <button type="button" onclick="window.print()" class="bg-white border border-slate-200 text-slate-800 font-bold text-sm py-3.5 rounded-xl hover:bg-slate-50 transition">Simpan / Cetak</button>
            <a href="{{ route('menu.index') }}" class="bg-[#700028] hover:bg-[#52001d] text-white font-bold text-sm py-3.5 rounded-xl text-center shadow-lg shadow-pink-900/20 transition">Pesan Lagi</a>
        </div>
        <a href="{{ route('landing') }}" class="block text-center text-xs font-bold text-slate-500 hover:text-[#700028] print:hidden">← Kembali ke Beranda</a>
    </main>

    <script>
        document.getElementById('copyBtn').addEventListener('click', async e => {
            const btn = e.currentTarget;
            try { await navigator.clipboard.writeText(document.getElementById('kodeTrx').textContent.trim()); btn.textContent = 'Tersalin ✓'; }
            catch { btn.textContent = 'Gagal menyalin'; }
            setTimeout(() => btn.textContent = 'Salin', 1800);
        });
        // Simpan pesanan aktif di perangkat ini supaya bisa dibuka lagi dari landing bila tab tertutup
        try {
            @if ($statusAktif)
                localStorage.setItem('wc_last_order', JSON.stringify({
                    kode: @json($order->kode_trks),
                    antrian: @json($nomorAntrian),
                    url: location.pathname,
                    day: new Date().toDateString(),
                }));
            @endif
            @if (! $statusAktif)
                localStorage.removeItem('wc_last_order');
            @endif
        } catch {}
        @if ($statusAktif)
            setTimeout(() => location.reload(), 30000);
        @endif
    </script>
</body>
</html>
