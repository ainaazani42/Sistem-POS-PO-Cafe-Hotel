@php
    $sesi = [
        ['Istirahat 1', '09:30 WIB', 'Istirahat 1 (09:30 WIB)'],
        ['Istirahat 2', '12:00 WIB', 'Istirahat 2 (12:00 WIB)'],
        ['Selesai Ekskul', '16:00 WIB', 'Selesai Ekskul (16:00 WIB)'],
    ];
@endphp

<section class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 sm:p-5">
    <div class="flex flex-wrap items-center justify-between gap-1 mb-3">
        <h2 class="text-sm font-extrabold text-slate-900">⏰ Pilih Jadwal Pickup PO</h2>
        <p class="text-[11px] text-slate-500">Ambil di counter sesuai sesi yang dipilih</p>
    </div>
    <div class="grid grid-cols-3 gap-2 sm:gap-3">
        @foreach ($sesi as $i => [$nama, $jam, $value])
            <button type="button" data-sesi="{{ $value }}" class="sesi-card text-left rounded-xl border-2 px-3 py-3 transition {{ $i === 0 ? 'border-[#700028] bg-pink-50' : 'border-slate-200 bg-white hover:border-slate-300' }}">
                <span class="flex items-center gap-2">
                    <span class="sesi-dot w-4 h-4 shrink-0 rounded-full border-2 {{ $i === 0 ? 'border-[#700028] bg-[#700028] ring-2 ring-inset ring-white' : 'border-slate-300' }}"></span>
                    <span class="text-[13px] sm:text-sm font-extrabold text-slate-900 leading-tight">{{ $nama }}</span>
                </span>
                <span class="block mt-1.5 pl-6 text-[11px] font-semibold text-slate-500">{{ $jam }}</span>
            </button>
        @endforeach
    </div>
</section>
