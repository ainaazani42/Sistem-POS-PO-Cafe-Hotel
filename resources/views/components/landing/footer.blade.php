<!-- FOOTER -->
<footer class="bg-[#1e2540] text-slate-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-[2fr_1fr_1fr] gap-8">
        <div>
            <div class="flex items-center gap-3 text-white font-bold">
                <span class="w-9 h-9 bg-[#700028] rounded-lg flex items-center justify-center">🎓</span> Wikrama Cafe &amp; Hotel
            </div>
            <p class="text-xs text-slate-400 mt-4 max-w-sm leading-relaxed">Unit Produksi &amp; Edukasi Kejuruan Kuliner &amp; Perhotelan SMK Wikrama Bogor. Mempersiapkan generasi koki, barista, dan hotelier berkarakter unggul dan siap kerja standar global.</p>
        </div>
        <div>
            <p class="text-white font-bold text-sm mb-3">Tautan Cepat</p>
            <ul class="space-y-2 text-xs text-slate-400">
                <li><a href="#beranda" class="hover:text-white">Beranda Landing</a></li>
                <li><a href="{{ route('menu.index') }}" class="hover:text-white">Menu Unggulan &amp; PO</a></li>
                <li><a href="#alur" class="hover:text-white">Alur Pemesanan Cepat</a></li>
                <li><a href="#akses" class="hover:text-white">Portal Masuk Siswa/Guru</a></li>
            </ul>
        </div>
        <div>
            <p class="text-white font-bold text-sm mb-3">Ketentuan Pesanan</p>
            <ul class="space-y-2 text-xs text-slate-400">
                <li>Metode Bayar: Tunai di Tempat</li>
                <li>Wajib Mengambil Sesuai Jam PO</li>
                <li>Simpan Bukti Nomor Antrean</li>
                <li>Kebijakan Mutu &amp; Halal Wikrama</li>
            </ul>
        </div>
    </div>
    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row gap-1 sm:justify-between text-[11px] text-slate-500">
            <span>© {{ date('Y') }} SMK Wikrama Bogor • Unit Teaching Factory Perhotelan. Hak Cipta Dilindungi.</span>
            <span>Terminal Kasir POS Versi 2.4.0 • Bogor, Jawa Barat</span>
        </div>
    </div>
</footer>
