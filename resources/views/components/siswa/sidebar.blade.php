@props(['student'])

@php
    $nav = [
        ['siswa.dashboard', '🍽️', 'Katalog & PO'],
        ['siswa.pesanan', '🎫', 'Pesanan Saya'],
        ['siswa.lacak', '🔎', 'Lacak Pesanan'],
    ];
@endphp

<aside id="sidebar" class="fixed inset-y-0 left-0 w-[260px] bg-[#1e2540] text-slate-300 flex flex-col z-50 -translate-x-full lg:translate-x-0 transition-transform duration-300">
    <div class="px-5 pt-6 pb-5 border-b border-white/10">
        <div class="flex items-center justify-between gap-3">
            <a href="{{ route('siswa.dashboard') }}" class="flex items-center gap-3 min-w-0">
                <span class="w-10 h-10 shrink-0 bg-[#700028] text-white rounded-xl flex items-center justify-center shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 3v7a2 2 0 002 2v9M10 3v7M8 3v7M18 21V3c-2 2-3 5-3 8h3"/></svg>
                </span>
                <span class="min-w-0">
                    <span class="block font-extrabold text-white leading-tight truncate">Wikrama Cafe Hotel</span>
                    <span class="block text-[11px] text-slate-400">Portal Siswa • Pre-Order</span>
                </span>
            </a>
            <button type="button" data-close-sidebar aria-label="Tutup menu" class="lg:hidden w-8 h-8 shrink-0 rounded-lg bg-white/10 text-slate-200 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M6 6l12 12M18 6L6 18"/></svg>
            </button>
        </div>
        
<div class="mt-5 flex items-center gap-3 bg-white/5 border border-white/10 rounded-xl p-3">
    <span class="w-10 h-10 shrink-0 rounded-full bg-[#700028] text-white text-sm font-bold flex items-center justify-center">
        {{ substr($student->name ?? $student['nama'] ?? 'G', 0, 1) }}
    </span>
    <span class="min-w-0">
        <span class="block text-sm font-bold text-white truncate">
            {{ $student->name ?? $student['nama'] ?? 'Tamu / Siswa' }}
        </span>
        <span class="block text-[11px] text-slate-400 truncate">
            {{ $student->kelas ?? $student['kelas'] ?? 'PPLG' }} • NIS {{ $student->nis ?? $student['nis'] ?? '-' }}
        </span>
    </span>
</div>

    <nav class="flex-1 overflow-y-auto px-3 py-5 space-y-1 text-sm font-semibold">
        @foreach ($nav as [$routeName, $icon, $label])
            <a href="{{ route($routeName) }}" class="flex items-center justify-between gap-3 px-3 py-3 rounded-xl transition {{ request()->routeIs($routeName) ? 'bg-[#700028] text-white shadow-lg shadow-black/20' : 'hover:bg-white/5' }}">
                <span class="flex items-center gap-3"><span class="w-5 text-center">{{ $icon }}</span> {{ $label }}</span>
                @if ($routeName === 'siswa.pesanan')
                    <span id="navMyOrderNo" class="hidden text-[10px] font-bold bg-orange-500 text-white px-2 py-0.5 rounded-full"></span>
                @endif
            </a>
        @endforeach
    </nav>

    <div class="px-3 pb-5 border-t border-white/10 pt-4">
        <a href="{{ route('landing') }}" class="flex items-center justify-center gap-2 text-xs font-bold text-[#f3b8c8] bg-white/5 hover:bg-white/10 rounded-xl py-3 transition">Keluar</a>
    </div>
</aside>
