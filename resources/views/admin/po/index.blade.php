@extends('admin.layout')

@section('title', 'Live Order')
@section('heading', 'Live Order Dapur')
@section('subheading', 'Antrean Pre-Order hari ini. Halaman diperbarui otomatis tiap 20 detik.')

@section('actions')
    <span id="clock" class="hidden sm:inline-flex items-center gap-2 bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs font-bold text-slate-700 tabular-nums">--:--:--</span>
    <button id="soundBtn" type="button" aria-pressed="true" class="inline-flex items-center gap-1.5 bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50 transition">
        <span id="soundIcon">🔔</span> <span id="soundLabel" class="hidden sm:inline">Audio Aktif</span>
    </button>
@endsection

@section('content')
    <main class="px-4 lg:px-8 py-5 pb-12 space-y-4">

        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-800 text-sm font-semibold px-4 py-3">✓ {{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 text-red-700 text-sm font-semibold px-4 py-3">{{ $errors->first() }}</div>
        @endif

        <!-- Filter kategori item -->
        <div class="flex gap-2 overflow-x-auto no-scrollbar">
            @foreach ([['semua', 'Semua'], ['makanan', '🍛 Makanan'], ['minuman', '🥤 Minuman'], ['snack', '🍟 Snack']] as $i => [$val, $label])
                <button type="button" data-filter="{{ $val }}" class="shrink-0 px-4 py-2 rounded-xl border text-xs font-bold transition {{ $i === 0 ? 'bg-[#700028] text-white border-[#700028]' : 'bg-white text-slate-700 border-slate-200 hover:border-slate-300' }}">{{ $label }}</button>
            @endforeach
        </div>

        <!-- Tab kolom (tablet & mobile) -->
        <div class="lg:hidden grid grid-cols-3 gap-2">
            @foreach ($kolom as $i => $k)
                <button type="button" data-tab="{{ $k['status'] }}" class="tab-btn rounded-xl border px-2 py-2.5 text-center transition {{ $i === 0 ? 'bg-slate-900 text-white border-slate-900' : 'bg-white text-slate-700 border-slate-200' }}">
                    <span class="block text-[11px] font-bold leading-tight">{{ $k['judul'] }}</span>
                    <span class="block text-lg font-extrabold leading-tight">{{ count($k['orders']) }}</span>
                </button>
            @endforeach
        </div>

        <!-- Kolom antrean -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
            @foreach ($kolom as $i => $k)
                <section data-col="{{ $k['status'] }}" class="{{ $i === 0 ? '' : 'hidden' }} lg:block min-w-0">
                    <div class="hidden lg:flex items-center justify-between mb-3 px-1">
                        <h2 class="font-extrabold text-slate-900">{{ $k['judul'] }}</h2>
                        <span class="text-xs font-bold rounded-full px-2.5 py-1 {{ $k['status'] === 'pending' ? 'bg-slate-800 text-white' : ($k['status'] === 'accepted' ? 'bg-orange-500 text-white' : 'bg-emerald-600 text-white') }}">{{ count($k['orders']) }}</span>
                    </div>

                    <div class="space-y-4">
                        @if (count($k['orders']) === 0)
                            <div class="rounded-2xl border-2 border-dashed border-slate-200 bg-white/60 text-center px-4 py-12">
                                <p class="text-3xl mb-2">{{ $k['status'] === 'pending' ? '☕' : ($k['status'] === 'accepted' ? '🍳' : '🛎️') }}</p>
                                <p class="text-sm font-bold text-slate-500">Tidak ada pesanan</p>
                            </div>
                        @endif

                        @foreach ($k['orders'] as $o)
                            <article data-order data-cats="{{ implode(' ', array_column($o['items'], 'kategori')) }}" class="rounded-2xl overflow-hidden bg-white border-2 shadow-sm {{ $o['prioritas'] ? 'border-red-500' : ($k['status'] === 'pending' ? 'border-slate-800' : ($k['status'] === 'accepted' ? 'border-orange-500' : 'border-emerald-600')) }}">
                                <div class="flex items-center justify-between gap-2 px-4 py-3 text-white {{ $o['prioritas'] ? 'bg-red-600' : ($k['status'] === 'pending' ? 'bg-slate-800' : ($k['status'] === 'accepted' ? 'bg-orange-500' : 'bg-emerald-600')) }}">
                                    <div class="min-w-0">
                                        <p class="text-xl font-extrabold leading-none">{{ $o['antrian'] }}</p>
                                        <p class="text-[10px] font-semibold text-white/80 mt-1">{{ $o['kode'] }}{{ $o['prioritas'] ? ' • PRIORITAS' : '' }}</p>
                                    </div>
                                    <span class="shrink-0 bg-white/20 rounded-lg px-2.5 py-1 text-[11px] font-bold">⏱ {{ $o['menit'] }} mnt lalu</span>
                                </div>

                                <div class="px-4 py-3 bg-slate-50 border-b border-slate-100 flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <p class="text-sm font-extrabold text-slate-900 truncate">{{ $o['nama'] }}</p>
                                        <p class="text-[11px] text-slate-500">NIS {{ $o['nis'] }}</p>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <p class="text-[10px] font-bold text-slate-400">PICKUP</p>
                                        <p class="text-xs font-bold text-slate-800">{{ $o['jadwal'] }}</p>
                                    </div>
                                </div>

                                <ul class="px-4 py-3 space-y-2.5">
                                    @foreach ($o['items'] as $it)
                                        <li class="flex items-center gap-3">
                                            <span class="w-9 h-9 shrink-0 rounded-lg bg-[#700028] text-white text-sm font-extrabold flex items-center justify-center">{{ $it['qty'] }}×</span>
                                            <span class="min-w-0">
                                                <span class="block text-sm font-bold text-slate-900 leading-tight">{{ $it['nama'] }}</span>
                                                <span class="block text-[10px] font-semibold uppercase tracking-wide text-slate-400">{{ $it['kategori'] }}</span>
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>

                                @if ($o['catatan'])
                                    <p class="mx-4 mb-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-xs font-semibold px-3 py-2.5">📝 {{ $o['catatan'] }}</p>
                                @endif

                                <form action="{{ route('admin.po.updateStatus', $o['id']) }}" method="POST" class="px-4 pb-4 flex gap-2">
                                    @csrf
                                    @method('PATCH')
                                    @if ($k['status'] === 'pending')
                                        <button type="submit" name="status" value="canceled" onclick="return confirm('Tolak pesanan {{ $o['antrian'] }}? Kuota akan dikembalikan.')" class="shrink-0 px-4 py-3 rounded-xl bg-slate-100 hover:bg-red-50 hover:text-red-600 text-slate-600 text-xs font-bold transition">Tolak</button>
                                        <button type="submit" name="status" value="accepted" class="flex-1 py-3 rounded-xl bg-orange-500 hover:bg-orange-600 text-white text-sm font-bold transition active:scale-[0.98]">Terima & Mulai Masak</button>
                                    @endif
                                    @if ($k['status'] === 'accepted')
                                        <button type="submit" name="status" value="pending" class="shrink-0 px-4 py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold transition">Ulangi</button>
                                        <button type="submit" name="status" value="ready" class="flex-1 py-3 rounded-xl bg-[#700028] hover:bg-[#52001d] text-white text-sm font-bold transition active:scale-[0.98]">✓ Tandai Siap Diambil</button>
                                    @endif
                                    @if ($k['status'] === 'ready')
                                        <button type="submit" name="status" value="accepted" class="shrink-0 px-4 py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold transition">Kembali</button>
                                        <button type="submit" name="status" value="completed" class="flex-1 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold transition active:scale-[0.98]">Sudah Diambil · Rp {{ number_format($o['total'], 0, ',', '.') }}</button>
                                    @endif
                                </form>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>

        <!-- Riwayat hari ini -->
        <details class="bg-white rounded-2xl border border-slate-200/80 shadow-sm">
            <summary class="cursor-pointer select-none px-5 py-4 flex items-center justify-between gap-3">
                <span class="font-extrabold text-slate-900">Selesai / Dibatalkan Hari Ini</span>
                <span class="text-xs font-bold bg-slate-100 text-slate-600 rounded-full px-2.5 py-1">{{ count($selesai) }}</span>
            </summary>
            <ul class="divide-y divide-slate-100 border-t border-slate-100">
                @foreach ($selesai as $r)
                    <li class="px-5 py-3 flex items-center justify-between gap-3 text-sm">
                        <div class="min-w-0">
                            <p class="font-bold text-slate-900">{{ $r['antrian'] }} <span class="text-[11px] font-semibold text-slate-400">{{ $r['kode'] }}</span></p>
                            <p class="text-xs text-slate-500 truncate">{{ $r['menu'] }}</p>
                        </div>
                        <span class="shrink-0 text-[11px] font-bold rounded-full px-2.5 py-1 {{ $r['status_class'] }}">{{ $r['status_label'] }}</span>
                    </li>
                @endforeach
                @if (count($selesai) === 0)
                    <li class="px-5 py-6 text-center text-sm text-slate-500">Belum ada pesanan selesai.</li>
                @endif
            </ul>
        </details>
    </main>
@endsection

@push('scripts')
    <script>
        const pendingNow = {{ count($kolom[0]['orders']) }};

        // Jam
        const clock = document.getElementById('clock');
        (function tick() { clock.textContent = new Date().toLocaleTimeString('id-ID'); setTimeout(tick, 1000); })();

        // Filter kategori (kartu tampil bila punya item di kategori itu)
        document.querySelectorAll('[data-filter]').forEach(b => b.addEventListener('click', () => {
            const kat = b.dataset.filter;
            document.querySelectorAll('[data-filter]').forEach(x => {
                const on = x === b;
                ['bg-[#700028]', 'text-white', 'border-[#700028]'].forEach(c => x.classList.toggle(c, on));
                ['bg-white', 'text-slate-700', 'border-slate-200'].forEach(c => x.classList.toggle(c, !on));
            });
            document.querySelectorAll('[data-order]').forEach(a => a.classList.toggle('hidden', kat !== 'semua' && !a.dataset.cats.split(' ').includes(kat)));
        }));

        // Tab kolom di layar kecil
        document.querySelectorAll('.tab-btn').forEach(b => b.addEventListener('click', () => {
            document.querySelectorAll('.tab-btn').forEach(x => {
                const on = x === b;
                ['bg-slate-900', 'text-white', 'border-slate-900'].forEach(c => x.classList.toggle(c, on));
                ['bg-white', 'text-slate-700', 'border-slate-200'].forEach(c => x.classList.toggle(c, !on));
            });
            document.querySelectorAll('[data-col]').forEach(c => c.classList.toggle('hidden', c.dataset.col !== b.dataset.tab));
        }));

        // Audio: bunyi saat ada pesanan baru masuk
        let soundOn = true;
        try { soundOn = localStorage.getItem('wc_kds_sound') !== 'off'; } catch {}
        const soundBtn = document.getElementById('soundBtn');
        function paintSound() {
            document.getElementById('soundIcon').textContent = soundOn ? '🔔' : '🔕';
            document.getElementById('soundLabel').textContent = soundOn ? 'Audio Aktif' : 'Audio Mati';
            soundBtn.setAttribute('aria-pressed', soundOn);
        }
        function beep() {
            try {
                const ctx = new (window.AudioContext || window.webkitAudioContext)(), o = ctx.createOscillator(), g = ctx.createGain();
                o.type = 'sine'; o.frequency.value = 880; g.gain.value = 0.15;
                o.connect(g); g.connect(ctx.destination); o.start(); o.stop(ctx.currentTime + 0.25);
            } catch {}
        }
        soundBtn.addEventListener('click', () => {
            soundOn = !soundOn; paintSound(); if (soundOn) beep();
            try { localStorage.setItem('wc_kds_sound', soundOn ? 'on' : 'off'); } catch {}
        });
        paintSound();
        try {
            const last = Number(sessionStorage.getItem('wc_kds_pending') ?? pendingNow);
            if (soundOn && pendingNow > last) beep();
            sessionStorage.setItem('wc_kds_pending', pendingNow);
        } catch {}

        // Muat ulang otomatis (dilewati saat tab tidak terlihat)
        setInterval(() => { if (!document.hidden) location.reload(); }, 20000);
    </script>
@endpush
