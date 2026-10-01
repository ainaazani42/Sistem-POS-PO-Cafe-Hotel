@extends('siswa.layout')

@section('title', 'Katalog PO Siswa')
@section('wrapper', 'lg:ml-[260px] lg:mr-[380px]')

@push('styles')
    <style>
        /* Desktop: keranjang tampil sebagai panel tetap di kanan (bukan popup) */
        @media (min-width: 1024px) {
            #cartRoot { display: block !important; position: fixed; inset: 0 0 0 auto; width: 380px; z-index: 30; }
            #cartRoot .backdrop { display: none; }
            #cartRoot .sheet { position: static; transform: none !important; width: 100%; height: 100vh; max-height: none; border-radius: 0; border-left: 1px solid #e2e8f0; box-shadow: none; }
            #cartRoot [data-close-cart], #cartBar { display: none !important; }
        }
    </style>
@endpush

@section('topbar')
    <div class="flex items-center gap-3 px-4 lg:px-8 pb-3 lg:py-4">
        <div class="relative flex-1 min-w-0">
            <svg class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.3-4.3M17 10a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input id="searchInput" type="search" placeholder="Cari menu PO (mis: nasi, kopi, snack)…" class="w-full pl-10 pr-4 py-3 rounded-xl bg-white border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
        </div>

        <a id="activeOrderChip" href="#" class="hidden shrink-0 items-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-700 px-3 py-2.5 text-xs font-bold hover:bg-emerald-100 transition">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span class="hidden sm:inline">Pesanan aktif</span> <span id="activeOrderChipNo"></span>
        </a>
    </div>
@endsection

@section('content')
    <main class="px-4 lg:px-8 py-5 space-y-5 pb-28 lg:pb-10">
        <x-siswa.banner />
        <x-siswa.jadwal />
        <x-siswa.filters />

        <div id="menuGrid" class="grid grid-cols-2 xl:grid-cols-3 gap-3 sm:gap-5"></div>

        <div id="emptyMenu" class="hidden text-center py-16">
            <div class="text-5xl mb-3">🍽️</div>
            <p class="font-bold text-slate-900">Menu tidak ditemukan</p>
            <p class="text-sm text-slate-500 mt-1">Coba kata kunci atau kategori lain.</p>
        </div>
    </main>

    <x-menu.cart-bar />
    <x-cart.drawer :student="$student" />
    <x-cart.scripts :menus="$menus" />
@endsection

@push('scripts')
    <script>
        // Sinkron pilihan jadwal antara kartu di halaman dan radio di keranjang
        const cards = [...document.querySelectorAll('.sesi-card')];
        const radios = [...document.querySelectorAll('input[name="jam_pengambilan"]')];
        function pickSesi(value) {
            cards.forEach(c => {
                const on = c.dataset.sesi === value, dot = c.querySelector('.sesi-dot');
                ['border-[#700028]', 'bg-pink-50'].forEach(k => c.classList.toggle(k, on));
                ['border-slate-200', 'bg-white'].forEach(k => c.classList.toggle(k, !on));
                ['border-[#700028]', 'bg-[#700028]', 'ring-2', 'ring-inset', 'ring-white'].forEach(k => dot.classList.toggle(k, on));
                dot.classList.toggle('border-slate-300', !on);
            });
            radios.forEach(r => r.checked = r.value === value);
        }
        cards.forEach(c => c.addEventListener('click', () => pickSesi(c.dataset.sesi)));
        radios.forEach(r => r.addEventListener('change', () => pickSesi(r.value)));
        pickSesi(cards[0].dataset.sesi);

        // Pesanan aktif (disimpan halaman status di localStorage)
        try {
            const o = JSON.parse(localStorage.getItem('wc_last_order') || 'null');
            if (o && o.day === new Date().toDateString()) {
                const chip = document.getElementById('activeOrderChip');
                chip.href = o.url; chip.classList.remove('hidden'); chip.classList.add('flex');
                document.getElementById('activeOrderChipNo').textContent = o.antrian;
            }
        } catch {}
    </script>
@endpush
