@php
    $nav = [['#beranda', 'Beranda'], ['#menu', 'Menu Unggulan'], ['#alur', 'Alur Pre-Order'], ['#lokasi', 'Lokasi Counter']];
@endphp

<!-- NAVBAR -->
<header class="bg-white/90 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 lg:h-[72px] flex items-center justify-between gap-3">
        <a href="#beranda" class="flex items-center gap-3 min-w-0">
            <div class="w-10 h-10 shrink-0 bg-[#700028] text-white rounded-xl flex items-center justify-center shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 3v7a2 2 0 002 2v9M10 3v7M8 3v7M18 21V3c-2 2-3 5-3 8h3"/></svg>
            </div>
            <div class="min-w-0">
                <div class="flex items-center gap-2">
                    <span class="font-bold text-sm sm:text-base leading-tight text-slate-900 truncate">Wikrama Cafe Hotel</span>
                    <span class="hidden sm:inline text-[10px] font-bold px-2 py-0.5 rounded-full bg-orange-50 text-orange-600">Teaching Factory</span>
                </div>
                <p class="text-[11px] text-slate-500 truncate">Perhotelan SMK Wikrama Bogor</p>
            </div>
        </a>

        <nav class="hidden lg:flex items-center gap-7 text-sm font-medium text-slate-600">
            @foreach ($nav as $i => [$href, $label])
                <a href="{{ $href }}" class="{{ $i === 0 ? 'text-[#700028] font-bold border-b-2 border-[#700028] py-1' : 'hover:text-[#700028] transition-colors' }}">{{ $label }}</a>
            @endforeach
        </nav>

        <div class="flex items-center gap-2 sm:gap-3">
            <span class="hidden xl:inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-700">
                <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                Counter Buka: 07.00 - 16.00 WIB
            </span>
            <a href="#akses" class="bg-[#700028] hover:bg-[#52001d] text-white text-xs font-bold px-3 sm:px-4 py-2.5 rounded-xl shadow-md transition-all flex items-center gap-2">
                <svg class="w-4 h-4 hidden sm:block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <span>Masuk<span class="hidden sm:inline"> / Daftar</span></span>
            </a>
            <button id="menuBtn" type="button" aria-label="Buka menu" class="lg:hidden p-2 rounded-lg border border-slate-200 text-slate-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>
    <nav id="mobileNav" class="hidden lg:hidden border-t border-slate-100 bg-white px-4 py-2">
        @foreach ($nav as [$href, $label])
            <a href="{{ $href }}" class="block py-3 text-sm font-semibold text-slate-700 border-b border-slate-50 last:border-0">{{ $label }}</a>
        @endforeach
        <p class="py-3 text-xs font-semibold text-slate-500 flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-orange-500"></span>Counter Buka: 07.00 - 16.00 WIB</p>
    </nav>
</header>

<script>
        document.getElementById('menuBtn').addEventListener('click', () => document.getElementById('mobileNav').classList.toggle('hidden'));
        document.querySelectorAll('#mobileNav a').forEach(a => a.addEventListener('click', () => document.getElementById('mobileNav').classList.add('hidden')));
</script>
