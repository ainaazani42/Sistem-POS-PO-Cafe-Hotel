@extends('siswa.layout')

@section('title', 'Lacak Pesanan')

@section('topbar')
    <div class="px-4 lg:px-8 pb-3 lg:py-4">
        <h1 class="text-lg font-extrabold text-slate-900">Lacak Pesanan</h1>
        <p class="hidden lg:block text-xs text-slate-500">Lihat status dan nomor antrian pesanan Pre-Order kamu.</p>
    </div>
@endsection

@section('content')
    <main class="px-4 lg:px-8 py-5 pb-10 grid grid-cols-1 gap-5 lg:grid-cols-2 items-start max-w-5xl">

        <!-- Pesanan aktif -->
        <section class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 sm:p-6">
            <h2 class="font-extrabold text-slate-900">Pesanan Aktif Kamu</h2>
            <p class="text-xs text-slate-500 mt-0.5">Ketuk untuk membuka tiket antrian.</p>

            @if (count($aktif) === 0)
                <div class="text-center py-10">
                    <div class="text-4xl mb-2">🍃</div>
                    <p class="text-sm font-bold text-slate-900">Tidak ada pesanan aktif</p>
                    <a href="{{ route('siswa.dashboard') }}" class="inline-block mt-4 text-sm font-bold text-[#700028] hover:underline">Pesan menu sekarang →</a>
                </div>
            @endif

            <ul class="mt-4 space-y-3">
                @foreach ($aktif as $r)
                    <li>
                        <a href="{{ $r['url'] }}" class="flex items-center gap-4 rounded-2xl border border-slate-200 hover:border-[#700028] hover:bg-pink-50/40 p-4 transition">
                            <span class="w-16 h-16 shrink-0 rounded-xl bg-gradient-to-br from-[#700028] to-[#4a0019] text-white flex flex-col items-center justify-center">
                                <span class="text-[9px] tracking-widest text-white/70">ANTRIAN</span>
                                <span class="text-lg font-extrabold leading-tight">{{ $r['antrian'] }}</span>
                            </span>
                            <span class="min-w-0 flex-1">
                                <span class="block text-sm font-bold text-slate-900 truncate">{{ $r['menu'] }}</span>
                                <span class="block text-[11px] text-slate-500 mt-0.5">🕘 {{ $r['jadwal'] }}</span>
                                <span class="inline-block mt-2 text-[11px] font-bold rounded-full px-2.5 py-1 {{ $r['status_class'] }}">{{ $r['status_label'] }}</span>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>

        <!-- Cari dengan kode -->
        <section class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 sm:p-6">
            <h2 class="font-extrabold text-slate-900">Cari dengan Kode Transaksi</h2>
            <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">Punya kode tiket (contoh: PO-7K2XQ9)? Masukkan di sini bersama nomor WhatsApp yang dipakai saat memesan.</p>

            <form action="{{ route('order.track') }}" method="POST" class="mt-5 space-y-4">
                @csrf
                <div>
                    <label for="lacak_kode" class="block text-xs font-bold text-slate-700 mb-1.5">Kode Transaksi</label>
                    <input id="lacak_kode" name="kode_trks" type="text" required autocapitalize="characters" placeholder="PO-XXXXXX" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                </div>
                <div>
                    <label for="lacak_wa" class="block text-xs font-bold text-slate-700 mb-1.5">No. WhatsApp</label>
                    <input id="lacak_wa" name="no_whatsapp" type="tel" inputmode="tel" required value="{{ $student['wa'] }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                </div>
                <p class="{{ session('lacak_error') ? '' : 'hidden' }} text-xs font-semibold text-red-600">{{ session('lacak_error') }}</p>
                <button type="submit" class="w-full bg-[#700028] hover:bg-[#52001d] text-white font-bold text-sm py-3.5 rounded-xl shadow-lg shadow-pink-900/20 transition">Lacak Pesanan</button>
            </form>
        </section>
    </main>
@endsection
