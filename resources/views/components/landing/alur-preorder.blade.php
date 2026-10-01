@php
    $langkah = [
        ['Pilih Menu & Pre-Order', 'Tentukan hidangan dan pilih jam istirahat pengambilan (Sesi 1 atau Sesi 2).'],
        ['Dapatkan Kode Tiket PO', 'Sistem menerbitkan nomor antrean digital & ringkasan pesanan otomatis.'],
        ['Ambil di Counter Jalur Cepat', 'Datang ke Counter Cafe Wikrama tanpa perlu antre panjang berdesakan.'],
        ['Bayar Tunai di Kasir', 'Selesaikan pembayaran langsung secara cash saat serah terima hidangan.'],
    ];
@endphp

<!-- ALUR PRE-ORDER -->
<section id="alur" class="bg-slate-50/70">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 lg:pb-16 pt-2">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 sm:p-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
            @foreach ($langkah as $i => [$judul, $desc])
                <div class="flex items-start gap-3">
                    <span class="w-9 h-9 shrink-0 rounded-lg flex items-center justify-center font-bold text-sm {{ $i % 2 ? 'bg-orange-100 text-orange-600' : 'bg-pink-100 text-[#700028]' }}">{{ $i + 1 }}</span>
                    <div><p class="text-sm font-bold text-slate-900">{{ $judul }}</p><p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">{{ $desc }}</p></div>
                </div>
            @endforeach
        </div>
    </div>
</section>
