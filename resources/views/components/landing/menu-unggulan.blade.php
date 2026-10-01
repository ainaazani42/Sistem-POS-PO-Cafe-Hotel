@props(['featured'])

@php
    $foto = [
        'makanan' => 'photo-1512058564366-18510be2db19',
        'minuman' => 'photo-1461023058943-07fcbe16d735',
        'snack' => 'photo-1496116218417-1a781b1c416c',
    ];
@endphp

<!-- MENU UNGGULAN -->
<section id="menu" class="bg-slate-50/70 border-y border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3 mb-8">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="text-[10px] font-bold px-2.5 py-1 rounded-full bg-pink-100 text-[#700028]">Produk Populer</span>
                    <span class="text-[11px] text-slate-500">Minggu Ini di Wikrama Cafe</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Menu Unggulan</h2>
                <p class="text-sm text-slate-600 mt-1">Dibuat langsung oleh siswa praktek perhotelan dengan bahan higienis terkurasi.</p>
            </div>
            <a href="{{ route('menu.index') }}" class="shrink-0 inline-flex items-center gap-1.5 text-sm font-bold text-[#700028] hover:underline">Lihat Semua Menu <span aria-hidden="true">→</span></a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach ($featured as $m)
                <article class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-lg transition-shadow overflow-hidden flex flex-col">
                    <div class="relative aspect-[16/10] overflow-hidden">
                        <img src="https://images.unsplash.com/{{ $foto[$m['kategori']] }}?auto=format&fit=crop&w=900&q=70" alt="{{ $m['nama'] }}" loading="lazy" class="w-full h-full object-cover">
                        <span class="absolute top-2.5 left-2.5 bg-[#700028] text-white text-[10px] font-bold px-2.5 py-1 rounded-md capitalize">{{ $m['kategori'] }}</span>
                        <span class="absolute bottom-2.5 right-2.5 text-white text-[10px] font-bold px-2.5 py-1 rounded-md {{ $m['sisa'] < 1 ? 'bg-slate-500' : 'bg-orange-500' }}">{{ $m['sisa'] < 1 ? 'Habis' : 'Sisa ' . $m['sisa'] }}</span>
                    </div>
                    <div class="p-4 flex flex-col flex-1">
                        <h3 class="font-bold text-slate-900">{{ $m['nama'] }}</h3>
                        <div class="flex items-end justify-between mt-auto pt-4">
                            <div><p class="text-[10px] text-slate-500">Harga Siswa/PO</p><p class="font-extrabold text-[#700028]">Rp {{ number_format($m['harga'], 0, ',', '.') }}</p></div>
                            <button type="button" data-add="{{ $m['id'] }}" data-sisa="{{ $m['sisa'] }}" data-nama="{{ $m['nama'] }}" {{ $m['sisa'] < 1 ? 'disabled' : '' }} aria-label="Tambah {{ $m['nama'] }} ke keranjang" class="h-9 pl-2.5 pr-3 rounded-lg bg-slate-100 hover:bg-[#700028] hover:text-white text-slate-700 text-xs font-bold flex items-center gap-1.5 transition active:scale-95 disabled:opacity-40 disabled:pointer-events-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.3 2.3c-.6.6-.2 1.7.7 1.7H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                Tambah
                            </button>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        @if ($featured->isEmpty())
            <p class="text-center text-sm text-slate-500 py-10">Menu belum tersedia. Silakan cek lagi nanti.</p>
        @endif

        <div class="mt-8 text-center">
            <a href="{{ route('menu.index') }}" class="inline-flex items-center justify-center gap-2 w-full sm:w-auto bg-[#700028] hover:bg-[#52001d] text-white font-bold text-sm px-8 py-3.5 rounded-xl shadow-lg shadow-pink-900/20 transition-all">
                Lihat Semua Menu &amp; Pre-Order <span aria-hidden="true">→</span>
            </a>
            <p class="text-[11px] text-slate-500 mt-3">Pemesanan PO ditutup saat kuota harian habis</p>
        </div>
    </div>
</section>
