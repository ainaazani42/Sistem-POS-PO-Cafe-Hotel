<header class="bg-white/90 backdrop-blur-md sticky top-0 z-40 border-b border-slate-100">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 h-14 sm:h-16 flex items-center justify-between gap-3">
        <div class="flex items-center gap-3 min-w-0">
            <a href="{{ route('landing') }}" aria-label="Kembali" class="w-9 h-9 shrink-0 rounded-xl border border-slate-200 flex items-center justify-center text-slate-700 hover:bg-slate-50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div class="min-w-0">
                <h1 class="font-extrabold text-slate-900 text-base sm:text-lg leading-tight truncate">Menu Pre-Order</h1>
                <p class="text-[11px] text-slate-500 truncate">Wikrama Cafe Hotel • Bayar tunai di counter</p>
            </div>
        </div>
        <button type="button" data-open-cart aria-label="Buka keranjang" class="relative w-10 h-10 shrink-0 rounded-xl bg-[#700028] text-white flex items-center justify-center shadow-md active:scale-95 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.3 2.3c-.6.6-.2 1.7.7 1.7H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            <span id="cartBadge" class="hidden absolute -top-1.5 -right-1.5 min-w-[20px] h-5 px-1 rounded-full bg-orange-500 text-white text-[11px] font-bold flex items-center justify-center ring-2 ring-white">0</span>
        </button>
    </div>
</header>
