<div class="sticky top-14 sm:top-16 z-30 -mx-4 sm:-mx-6 px-4 sm:px-6 py-3 bg-slate-50/95 backdrop-blur space-y-3">
    <div class="relative">
        <svg class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.3-4.3M17 10a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        <input id="searchInput" type="search" placeholder="Cari menu favoritmu…" class="w-full pl-10 pr-4 py-3 rounded-xl bg-white border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
    </div>
    <div class="flex items-center justify-between gap-3">
        <div class="flex gap-2 overflow-x-auto no-scrollbar -mx-4 px-4 sm:mx-0 sm:px-0">
            @foreach ([['semua', 'Semua'], ['makanan', '🍛 Makanan'], ['minuman', '🥤 Minuman'], ['snack', '🍟 Snack']] as $i => [$val, $label])
                <button type="button" data-cat="{{ $val }}" class="shrink-0 px-4 py-2 rounded-full border text-xs font-bold transition {{ $i === 0 ? 'bg-[#700028] text-white border-[#700028]' : 'bg-white text-slate-700 border-slate-200' }}">{{ $label }}</button>
            @endforeach
        </div>
        <span id="menuCount" class="hidden sm:block shrink-0 text-xs text-slate-500"></span>
    </div>
</div>
