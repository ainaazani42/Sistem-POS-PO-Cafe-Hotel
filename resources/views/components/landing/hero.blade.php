<!-- HERO -->
<section id="beranda" class="bg-gradient-to-br from-white via-white to-pink-50/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16 grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-14 items-center">
        <div class="space-y-6">
            <span class="inline-flex flex-wrap items-center gap-x-2 gap-y-0.5 px-3 py-1.5 bg-white border border-slate-200 rounded-2xl text-[11px] font-medium text-slate-600 shadow-sm">
                <span class="text-orange-500">✓</span> Standar Industri &amp; Hotel Bintang 4
                <span class="text-slate-300">•</span>
                <span class="font-bold text-[#700028]">SMK Wikrama Bogor</span>
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-[44px] font-extrabold text-slate-900 leading-tight tracking-tight">
                Cita Rasa Kuliner Hotel<br>
                <span class="text-[#700028]">Berstandar Industri</span> di Lingkungan Sekolah
            </h1>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-xl">
                Pesan makanan &amp; minuman kreasi siswa Jurusan Perhotelan SMK Wikrama. Praktis via Pre-Order (PO) ambil saat istirahat atau nikmati langsung di cafe.
            </p>
            <div class="flex flex-col sm:flex-row sm:flex-wrap gap-3">
                <a href="{{ route('menu.index') }}" class="bg-[#700028] hover:bg-[#52001d] text-white font-bold text-sm px-6 py-3.5 rounded-xl shadow-lg shadow-pink-900/20 transition-all flex items-center justify-center gap-2 whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 3v7a2 2 0 002 2v9M10 3v7M8 3v7M18 21V3c-2 2-3 5-3 8h3"/></svg>
                    Lihat Menu &amp; Pre-Order
                </a>
                <a href="{{ route('menu.index') }}" class="bg-white hover:bg-slate-50 text-slate-800 font-bold text-sm px-5 py-3.5 rounded-xl border border-slate-200 shadow-sm transition-all flex items-center justify-center gap-2 whitespace-nowrap">
                    <span class="text-orange-500">⚡</span>
                    <span>Lanjutkan sebagai Tamu / Guest</span>
                    <span class="shrink-0 whitespace-nowrap text-[10px] font-bold px-2 py-0.5 rounded-full bg-orange-100 text-orange-600">Tanpa Ribet</span>
                </a>
            </div>
            <div class="grid grid-cols-3 gap-4 pt-6 max-w-lg">
                <div><p class="text-2xl sm:text-3xl font-extrabold text-[#700028]">100%</p><p class="text-[11px] text-slate-500 mt-1">Halal &amp; Higienis HACCP</p></div>
                <div><p class="text-2xl sm:text-3xl font-extrabold text-orange-600">07.00</p><p class="text-[11px] text-slate-500 mt-1">Freshly Baked Daily</p></div>
                <div><p class="text-2xl sm:text-3xl font-extrabold text-slate-900">15 Menit</p><p class="text-[11px] text-slate-500 mt-1">Jalur Cepat Ambil PO</p></div>
            </div>
        </div>

        <div class="relative pb-10">
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-3">
                <div class="relative rounded-2xl overflow-hidden aspect-[4/3]">
                    <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=900&q=70" alt="Croissant dan kopi latte" class="w-full h-full object-cover">
                    <span class="absolute top-3 left-3 bg-white/95 text-[11px] font-semibold text-slate-700 px-3 py-1.5 rounded-full shadow">🥐 Freshly Baked Daily</span>
                    <span class="absolute bottom-3 right-3 bg-[#700028] text-white text-xs sm:text-sm font-bold px-3 py-1.5 rounded-lg">Kreasi Siswa Kuliner Wikrama</span>
                </div>
                <div class="hidden sm:grid grid-cols-2 gap-3 mt-3">
                    <div class="flex items-center gap-3 bg-slate-50 rounded-xl p-3">
                        <div class="w-9 h-9 rounded-lg bg-pink-100 text-[#700028] flex items-center justify-center">🥖</div>
                        <div><p class="text-xs font-bold">Pastry &amp; Bakery</p><p class="text-[11px] text-slate-500">Menteoa Nabati Prancis</p></div>
                    </div>
                    <div class="flex items-center gap-3 bg-slate-50 rounded-xl p-3">
                        <div class="w-9 h-9 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center">☕</div>
                        <div><p class="text-xs font-bold">Barista Brew</p><p class="text-[11px] text-slate-500">Espresso Blend Lokal</p></div>
                    </div>
                </div>
            </div>
            <div class="absolute -bottom-0 left-2 sm:-left-4 flex items-center gap-3 bg-white rounded-xl shadow-lg border border-slate-100 px-4 py-3 max-w-[85%]">
                <div class="w-8 h-8 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center shrink-0">⏰</div>
                <div><p class="text-xs font-bold text-slate-900">Pre-Order Sesi 1 Dibuka!</p><p class="text-[11px] text-slate-500">Ambil saat istirahat pukul 09.45 WIB</p></div>
            </div>
        </div>
    </div>
</section>
