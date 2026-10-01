<!-- Pintasan ke pesanan aktif (dibaca dari localStorage, diisi oleh halaman status) -->
<a id="activeOrder" href="#" class="hidden fixed bottom-5 left-4 z-50 max-w-[calc(100vw-6.5rem)] items-center gap-3 bg-white border border-slate-200 rounded-2xl shadow-2xl pl-3 pr-4 py-2.5">
    <span class="w-9 h-9 shrink-0 rounded-xl bg-[#700028] text-white flex items-center justify-center">🎫</span>
    <span class="min-w-0">
        <span class="block text-[10px] font-semibold text-slate-500">Pesanan aktif</span>
        <span class="block text-sm font-extrabold text-[#700028] truncate">Antrian <span id="activeOrderNo"></span> • Lihat</span>
    </span>
</a>
<script>
    (() => {
        try {
            const o = JSON.parse(localStorage.getItem('wc_last_order') || 'null');
            if (!o || o.day !== new Date().toDateString()) return;   // hanya berlaku hari yang sama
            const a = document.getElementById('activeOrder');
            a.href = o.url;
            document.getElementById('activeOrderNo').textContent = o.antrian;
            a.classList.remove('hidden'); a.classList.add('flex');
        } catch {}
    })();
</script>
