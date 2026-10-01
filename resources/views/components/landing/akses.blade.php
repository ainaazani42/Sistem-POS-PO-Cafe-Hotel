<!-- AKSES / LOGIN -->
<section id="akses" class="border-t border-slate-100">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 py-12 lg:py-16">
        <div class="text-center mb-8">
            <span
                class="inline-flex items-center gap-1.5 text-[10px] font-bold px-3 py-1 rounded-full bg-pink-100 text-[#700028]">🔑
                Portal Masuk Siswa &amp; Guru</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-4">Akses Sistem Pre-Order &amp; Kasir</h2>
            <p class="text-sm text-slate-600 mt-2">Masuk dengan akun terdaftar atau pesan cepat tanpa akun melalui mode
                Tamu.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
            <div
                class="bg-orange-50 border-b border-orange-100 px-4 sm:px-6 py-3 flex gap-3 text-[11px] sm:text-xs text-slate-700 leading-relaxed">
                <span class="shrink-0">💵</span>
                <p><span class="font-bold text-orange-600">SOP Pembayaran Penting:</span> Pembayaran seluruh pesanan
                    Pre-Order dilakukan secara <b>TUNAI (Cash)</b> langsung di kasir Counter Cafe saat pengambilan
                    pesanan.</p>
            </div>

            <div class="grid grid-cols-2 bg-slate-50 border-b border-slate-100 text-sm font-semibold">
                <button type="button" data-tab="login"
                    class="tab-btn py-3.5 text-[#700028] border-b-2 border-[#700028] bg-white">Masuk (Login)</button>
                <button type="button" data-tab="daftar"
                    class="tab-btn py-3.5 text-slate-600 border-b-2 border-transparent">Daftar Akun Baru <span
                        class="hidden sm:inline">(Siswa/Guru)</span></button>
            </div>

            @if ($errors->has('user_login'))
                <p class="px-5 sm:px-8 pt-5 text-sm font-semibold text-red-600">{{ $errors->first('user_login') }}</p>
            @endif
            <form id="form-login" data-panel="login" action="{{ route('user.login.store') }}" method="POST"
                class="p-5 sm:p-8 space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2">NIS / Email</label>
                    <input name="email" type="email" value="{{ old('email') }}" required
                        placeholder="nama@email.com"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                </div>
                <div>
                    <div class="flex justify-between mb-2"><label class="text-xs font-bold text-slate-700">Kata Sandi
                            (Password)</label><a href="#" class="text-xs font-semibold text-orange-600">Lupa
                            sandi?</a></div>
                    <input name="password" type="password" required placeholder="Masukkan kata sandi akun"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                </div>
                <div class="flex flex-wrap items-center justify-between gap-2 text-xs text-slate-500">
                    <label class="flex items-center gap-2"><input type="checkbox" class="rounded border-slate-300">
                        Ingat saya di perangkat ini</label>
                    <span>Terhubung ke Database Sekolah</span>
                </div>
                <button type="submit"
                    class="w-full bg-[#700028] hover:bg-[#52001d] text-white font-bold text-sm py-3.5 rounded-xl shadow-lg shadow-pink-900/20 transition-all">Masuk
                    ke Akun Pre-Order →</button>
            </form>

            <form id="form-daftar" data-panel="daftar" action="{{ route('user.register.store') }}" method="POST"
                class="hidden p-5 sm:p-8 space-y-5">
                @csrf
                <div>
                    <label for="reg_nama" class="block text-xs font-bold text-slate-700 mb-2">Nama Lengkap</label>
                    <input id="reg_nama" name="name" type="text" required autocomplete="name"
                        placeholder="Nama sesuai data sekolah"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                </div>
                <div>
                    <label for="reg_nis" class="block text-xs font-bold text-slate-700 mb-2">NIS</label>
                    <input id="reg_nis" name="nis" type="text" inputmode="numeric" pattern="[0-9]*" required
                        placeholder="Contoh: 12108500"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                </div>
                <div>
                    <label for="reg_email" class="block text-xs font-bold text-slate-700 mb-2">Email</label>
                    <input id="reg_email" name="email" type="email" required autocomplete="email"
                        placeholder="nama@email.com"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                </div>
                <div>
                    <label for="reg_kelas" class="block text-xs font-bold text-slate-700 mb-2">Kelas (opsional)</label>
                    <input id="reg_kelas" name="kelas" type="text" value="{{ old('kelas') }}"
                        placeholder="Contoh: XI PPLG 1"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                </div>
                <div>
                    <label for="reg_wa" class="block text-xs font-bold text-slate-700 mb-2">No. WhatsApp
                        (opsional)</label>
                    <input id="reg_wa" name="no_whatsapp" type="tel" value="{{ old('no_whatsapp') }}"
                        placeholder="081234567890"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                </div>
                <div>
                    <label for="reg_password" class="block text-xs font-bold text-slate-700 mb-2">Kata Sandi
                        (Password)</label>
                    <input id="reg_password" name="password" type="password" required minlength="8"
                        autocomplete="new-password" placeholder="Minimal 8 karakter"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                </div>
                <div>
                    <label for="reg_password_confirmation"
                        class="block text-xs font-bold text-slate-700 mb-2">Konfirmasi Password</label>
                    <input id="reg_password_confirmation" name="password_confirmation" type="password" required
                        minlength="8" autocomplete="new-password" placeholder="Ulangi password"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                </div>
                <button type="submit"
                    class="w-full bg-[#700028] hover:bg-[#52001d] text-white font-bold text-sm py-3.5 rounded-xl shadow-lg shadow-pink-900/20 transition-all">Daftar
                    Akun Baru →</button>
            </form>
            @if ($errors->any() && !$errors->has('user_login'))
                <p class="px-5 sm:px-8 pb-5 text-xs text-center text-red-600 font-semibold">{{ $errors->first() }}</p>
            @endif
        </div>
    </div>
</section>

<script>
    document.querySelectorAll('.tab-btn').forEach(btn => btn.addEventListener('click', () => {
        document.querySelectorAll('.tab-btn').forEach(b => {
            const on = b === btn;
            b.classList.toggle('text-[#700028]', on);
            b.classList.toggle('border-[#700028]', on);
            b.classList.toggle('bg-white', on);
            b.classList.toggle('text-slate-600', !on);
            b.classList.toggle('border-transparent', !on);
        });
        document.querySelectorAll('[data-panel]').forEach(p => p.classList.toggle('hidden', p.dataset
            .panel !== btn.dataset.tab));
    }));
</script>
