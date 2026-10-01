@props(['student' => null])

<style>
    /* animasi drawer: bottom sheet di mobile, panel kanan di desktop */
    #cartRoot .backdrop { opacity: 0; transition: opacity .3s; }
    #cartRoot .sheet { transform: translateY(100%); transition: transform .3s cubic-bezier(.32,.72,0,1); }
    #cartRoot.open .backdrop { opacity: 1; }
    #cartRoot.open .sheet { transform: none; }
    @media (min-width: 768px) { #cartRoot .sheet { transform: translateX(100%); } }
</style>

<div id="cartRoot" class="fixed inset-0 z-[60] hidden" role="dialog" aria-modal="true" aria-label="Keranjang Pre-Order">
    <div data-close-cart class="backdrop absolute inset-0 bg-slate-900/50"></div>

    <form id="cartForm" action="{{ route('order.storePo') }}" method="POST"
          class="sheet absolute bottom-0 inset-x-0 md:inset-y-0 md:left-auto md:w-[440px] max-h-[92vh] md:max-h-none bg-white rounded-t-3xl md:rounded-none shadow-2xl flex flex-col">
        @csrf
        <div id="hiddenItems"></div>

        <!-- header -->
        <div class="shrink-0 pt-2.5 md:pt-0">
            <div class="md:hidden mx-auto w-10 h-1.5 rounded-full bg-slate-200"></div>
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                <div>
                    <h2 class="text-lg font-extrabold text-slate-900">Keranjang Pre-Order</h2>
                    <p id="cartTitleCount" class="text-xs text-slate-500"></p>
                </div>
                <button type="button" data-close-cart aria-label="Tutup" class="w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M6 6l12 12M18 6L6 18"/></svg>
                </button>
            </div>
        </div>

        <!-- empty -->
        <div id="cartEmpty" class="hidden flex-1 flex flex-col items-center justify-center text-center px-8 py-16">
            <div class="w-20 h-20 rounded-full bg-pink-50 flex items-center justify-center text-4xl mb-4">🛒</div>
            <p class="font-bold text-slate-900">Keranjangmu masih kosong</p>
            <p class="text-sm text-slate-500 mt-1">Pilih menu favoritmu dulu, yuk!</p>
            <button type="button" data-close-cart class="mt-5 bg-[#700028] text-white text-sm font-bold px-6 py-3 rounded-xl">Lihat Menu</button>
        </div>

        <!-- filled -->
        <div id="cartFilled" class="flex-1 overflow-y-auto overscroll-contain px-5">
            <ul id="cartItems" class="divide-y divide-slate-100"></ul>

            <div class="py-5 border-t border-slate-100 space-y-4">
                <h3 class="text-sm font-extrabold text-slate-900">Data Pemesan</h3>
                <div>
                    <label for="nama_pelanggan" class="block text-xs font-bold text-slate-700 mb-1.5">Nama / Kelas</label>
                    <input id="nama_pelanggan" name="nama_pelanggan" type="text" required autocomplete="name" placeholder="Contoh: Aina / XII RPL 1" value="{{ $student ? $student['nama'] . ' / ' . $student['kelas'] : '' }}" {{ $student ? 'readonly' : '' }} class="w-full px-4 py-3 rounded-xl border border-slate-200 {{ $student ? 'bg-slate-100 text-slate-500' : 'bg-slate-50' }} text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                </div>
                <div>
                    <label for="nis" class="block text-xs font-bold text-slate-700 mb-1.5">NIS</label>
                    <input id="nis" name="nis" type="text" inputmode="numeric" pattern="[0-9]{4,20}" required autocomplete="off" placeholder="Contoh: 12108500" value="{{ $student ? $student['nis'] : '' }}" {{ $student ? 'readonly' : '' }} class="w-full px-4 py-3 rounded-xl border border-slate-200 {{ $student ? 'bg-slate-100 text-slate-500' : 'bg-slate-50' }} text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                </div>
                <div>
                    <label for="no_whatsapp" class="block text-xs font-bold text-slate-700 mb-1.5">No. WhatsApp</label>
                    <input id="no_whatsapp" name="no_whatsapp" type="tel" inputmode="tel" required autocomplete="tel" placeholder="081234567890" value="{{ $student ? $student['wa'] : '' }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                </div>
                <fieldset>
                    <legend class="block text-xs font-bold text-slate-700 mb-1.5">Jam Pengambilan</legend>
                    <div class="grid gap-2">
                        @foreach (['Istirahat 1 (09:30 WIB)', 'Istirahat 2 (12:00 WIB)', 'Selesai Ekskul (16:00 WIB)'] as $sesi)
                            <label class="cursor-pointer">
                                <input type="radio" name="jam_pengambilan" value="{{ $sesi }}" required class="peer sr-only">
                                <span class="flex items-center gap-3 px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-700 peer-checked:border-[#700028] peer-checked:bg-pink-50 peer-checked:text-[#700028] peer-focus-visible:ring-2 peer-focus-visible:ring-[#700028]/40 transition">
                                    <span class="w-4 h-4 rounded-full border-2 border-slate-300"></span>{{ $sesi }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </fieldset>
                <div>
                    <label for="catatan" class="block text-xs font-bold text-slate-700 mb-1.5">Catatan <span class="font-medium text-slate-400">(opsional)</span></label>
                    <textarea id="catatan" name="catatan" rows="2" placeholder="Contoh: tidak pakai pedas" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]"></textarea>
                </div>
                <p class="text-[11px] leading-relaxed text-orange-700 bg-orange-50 border border-orange-100 rounded-xl px-3 py-2.5">💵 Pembayaran dilakukan <b>tunai</b> di kasir Counter Cafe saat pengambilan pesanan.</p>
            </div>
        </div>

        <!-- footer -->
        <div id="cartFooter" class="shrink-0 border-t border-slate-100 bg-white px-5 pt-4 pb-[max(1rem,env(safe-area-inset-bottom))] space-y-3">
            <dl class="text-sm space-y-1.5">
                <div class="flex justify-between text-slate-600"><dt>Subtotal</dt><dd id="sumSub" class="font-semibold text-slate-800">Rp 0</dd></div>
                <div class="flex justify-between text-slate-600"><dt>Biaya admin PO</dt><dd id="sumFee" class="font-semibold text-slate-800">Rp 0</dd></div>
                <div class="flex justify-between text-base font-extrabold text-slate-900 pt-1.5 border-t border-dashed border-slate-200"><dt>Total</dt><dd id="sumTotal" class="text-[#700028]">Rp 0</dd></div>
            </dl>
            <button id="submitBtn" type="submit" class="w-full bg-[#700028] hover:bg-[#52001d] text-white font-bold text-sm py-4 rounded-2xl shadow-lg shadow-pink-900/20 transition active:scale-[0.98] flex items-center justify-center gap-2">
                <span id="submitLabel">Kirim Pre-Order</span><span>•</span><span id="submitTotal">Rp 0</span>
            </button>
        </div>
    </form>
</div>

<div id="toast" class="fixed left-1/2 -translate-x-1/2 bottom-24 md:bottom-8 z-[70] max-w-[90vw] bg-slate-900 text-white text-xs font-semibold px-4 py-2.5 rounded-xl shadow-xl opacity-0 translate-y-2 transition pointer-events-none"></div>
