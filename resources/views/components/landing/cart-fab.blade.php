<!-- Tombol keranjang mengambang (muncul setelah ada item) -->
<button id="cartFab" type="button" data-open-cart aria-label="Buka keranjang"
   class="fixed bottom-5 right-5 z-50 w-14 h-14 rounded-full bg-[#700028] text-white shadow-2xl shadow-pink-900/40 flex items-center justify-center transition duration-300 scale-0 opacity-0 pointer-events-none">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.3 2.3c-.6.6-.2 1.7.7 1.7H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
    <span id="fabBadge" class="absolute -top-1 -right-1 min-w-[22px] h-[22px] px-1 rounded-full bg-orange-500 text-white text-[11px] font-bold flex items-center justify-center ring-2 ring-white">0</span>
</button>
