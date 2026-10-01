<!-- LACAK PESANAN -->
<section id="lacak" class="border-t border-slate-100 bg-white">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 py-10">
        <div class="bg-pink-50/60 border border-pink-100 rounded-2xl p-5 sm:p-7">
            <div class="flex items-start gap-3">
                <span class="w-10 h-10 shrink-0 rounded-xl bg-[#700028] text-white flex items-center justify-center">🎫</span>
                <div>
                    <h2 class="text-lg font-extrabold text-slate-900">Sudah Pre-Order? Lacak Pesananmu</h2>
                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">Tab tidak sengaja tertutup? Masukkan kode transaksi (contoh: PO-7K2XQ9) dan nomor WhatsApp saat memesan untuk melihat nomor antrianmu lagi.</p>
                </div>
            </div>
            <form action="{{ route('order.track') }}" method="POST" class="mt-5 grid gap-3 sm:grid-cols-[1fr_1fr_auto] sm:items-end">
                @csrf
                <div>
                    <label for="lacak_kode" class="block text-xs font-bold text-slate-700 mb-1.5">Kode Transaksi</label>
                    <input id="lacak_kode" name="kode_trks" type="text" required autocapitalize="characters" placeholder="PO-XXXXXX" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                </div>
                <div>
                    <label for="lacak_wa" class="block text-xs font-bold text-slate-700 mb-1.5">No. WhatsApp</label>
                    <input id="lacak_wa" name="no_whatsapp" type="tel" inputmode="tel" required placeholder="081234567890" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                </div>
                <button type="submit" class="bg-[#700028] hover:bg-[#52001d] text-white font-bold text-sm px-6 py-3 rounded-xl shadow-lg shadow-pink-900/20 transition">Lacak</button>
            </form>
            <p class="{{ session('lacak_error') ? '' : 'hidden' }} mt-3 text-xs font-semibold text-red-600">{{ session('lacak_error') }}</p>
        </div>
    </div>
</section>
