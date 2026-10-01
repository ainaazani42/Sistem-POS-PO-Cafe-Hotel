<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wikrama Cafe Hotel - Pre-Order & Kasir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-800 antialiased">

    <!-- NAVBAR HEADER -->
    <header class="bg-white/90 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Logo & Title -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-[#700028] text-white rounded-xl flex items-center justify-center font-bold text-lg shadow-md">
                    W
                </div>
                <div>
                    <h1 class="font-bold text-lg leading-tight text-slate-900">Wikrama Cafe Hotel</h1>
                    <p class="text-xs text-slate-500 font-medium">Cita Rasa Kuliner Berstandar Industri</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600">
                <a href="#beranda" class="text-[#700028] font-bold">Beranda</a>
                <a href="#menu" class="hover:text-[#700028] transition-colors">Menu Unggulan</a>
                <a href="#cara-pesan" class="hover:text-[#700028] transition-colors">Cara Pre-Order</a>
                <a href="#lokasi" class="hover:text-[#700028] transition-colors">Lokasi Counter</a>
            </nav>

            <!-- Status Open/Login Button -->
            <div class="flex items-center gap-3">
                <span class="hidden sm:inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold border border-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Counter Buka: 07.00 - 16.00 WIB
                </span>
                <a href="{{ route('landing') }}#akses" class="bg-[#700028] hover:bg-[#52001d] text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow-md transition-all">
                    Masuk / Kasir
                </a>
            </div>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section id="beranda" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <!-- Left Text Content -->
            <div class="lg:col-span-7 space-y-6">
                <span class="inline-block px-3 py-1 bg-pink-50 border border-pink-200 text-[#700028] font-bold text-xs rounded-full">
                    Kuliner Berstandar Industri • SMK Wikrama Bogor
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 leading-tight">
                    Cita Rasa Kuliner Hotel <br class="hidden sm:inline">
                    <span class="text-[#700028]">Berstandar Industri</span> di Lingkungan Sekolah
                </h2>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-2xl">
                    Nikmati kelezatan menu racikan siswa-siswi jurusan Perhotelan & Kuliner SMK Wikrama Bogor. Pesan lebih awal tanpa perlu mengantre lama saat jam istirahat!
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="#form-po" class="bg-[#700028] hover:bg-[#52001d] text-white font-bold text-sm px-6 py-3.5 rounded-xl shadow-lg shadow-pink-900/10 transition-all flex items-center gap-2">
                        Pesan Menu Pre-Order
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="#menu" class="bg-white hover:bg-slate-50 text-slate-700 font-bold text-sm px-6 py-3.5 rounded-xl border border-slate-200 transition-all">
                        Lihat Katalog Menu
                    </a>
                </div>

                <!-- Stats Badges -->
                <div class="grid grid-cols-3 gap-4 pt-6 border-t border-slate-200 max-w-lg">
                    <div>
                        <p class="text-2xl font-extrabold text-[#700028]">100%</p>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Bahan Higienis</p>
                    </div>
                    <div>
                        <p class="text-2xl font-extrabold text-[#700028]">07.00</p>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Pemesanan Awal</p>
                    </div>
                    <div>
                        <p class="text-2xl font-extrabold text-[#700028]">15 Menit</p>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Estimasi Pick-up</p>
                    </div>
                </div>
            </div>

            <!-- Right Banner Image -->
            <div class="lg:col-span-5 relative">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
                    <img src="https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=800&q=80" alt="Cafe Banner" class="w-full h-80 sm:h-96 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent flex flex-col justify-end p-6 text-white">
                        <span class="bg-[#700028] text-white text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md w-fit mb-2">Wikrama Cafe & Hotel</span>
                        <h3 class="text-lg font-bold">Kopi & Bakery Fresh Setiap Hari</h3>
                        <p class="text-xs text-slate-200 mt-1">Dibuat langsung oleh siswa-siswi talenta muda Wikrama.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MENU UNGGULAN KATALOG -->
    <section id="menu" class="bg-white py-12 border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8">
                <div>
                    <span class="text-xs font-bold text-[#700028] uppercase tracking-wider">Pilihan Terbaik</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1">Menu Unggulan Cafe</h2>
                </div>
                <p class="text-xs text-slate-500 mt-2 md:mt-0">*Kuota Pre-Order diupdate setiap hari secara otomatis</p>
            </div>

            <!-- Grid Menu -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($menus as $index => $menu)
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                        <div>
                            <!-- Placeholder Image Menu -->
                            <div class="relative h-44 bg-slate-100">
                                <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=500&q=80" alt="{{ $menu->nama_menu }}" class="w-full h-full object-cover">
                                <span class="absolute top-3 left-3 bg-[#700028] text-white text-[10px] font-bold px-2.5 py-1 rounded-lg uppercase">
                                    {{ $menu->kategori }}
                                </span>
                            </div>
                            <div class="p-4 space-y-2">
                                <h3 class="font-bold text-slate-900 text-base leading-snug">{{ $menu->nama_menu }}</h3>
                                <p class="text-xs text-slate-500 line-clamp-2">Menu lezat khas Wikrama Cafe disajikan dengan bahan berkualitas.</p>
                                <div class="flex items-center justify-between pt-2">
                                    <span class="text-xs font-medium text-slate-500">Sisa Kuota: <strong class="text-slate-800">{{ $menu->kuota_po - $menu->terjual_po }}</strong></span>
                                    <span class="text-base font-extrabold text-[#700028]">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FORM PRE-ORDER SECTION -->
    <section id="form-po" class="py-14 bg-slate-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-8">
                <span class="bg-pink-100 text-[#700028] text-xs font-bold px-3 py-1 rounded-full border border-pink-200">Formulir Pesanan</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Akses Sistem Pre-Order Cafe</h2>
                <p class="text-slate-500 text-sm mt-1">Isi data di bawah ini untuk memesan makanan/minuman sebelum diambil di counter.</p>
            </div>

            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl text-sm mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-xl">
                <form action="{{ route('order.storePo') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Form Input Data Pelanggan -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-2">Nama Lengkap / Rombongan</label>
                            <input type="text" name="nama_pelanggan" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#700028] focus:border-transparent transition-all" placeholder="Contoh: Aina Prasanti / XII RPL 1">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-2">NIS</label>
                            <input type="text" name="nis" inputmode="numeric" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#700028] focus:border-transparent transition-all" placeholder="Contoh: 12108500">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-2">No. WhatsApp (Untuk Konfirmasi Status)</label>
                            <input type="text" name="no_whatsapp" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#700028] focus:border-transparent transition-all" placeholder="Contoh: 081234567890">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-2">Pilih Jam Pengambilan</label>
                            <select name="jam_pengambilan" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#700028] focus:border-transparent transition-all">
                                <option value="">-- Pilih Sesi Jam Pengambilan --</option>
                                <option value="Istirahat 1 (09:30 WIB)">Istirahat 1 (09:30 WIB)</option>
                                <option value="Istirahat 2 (12:00 WIB)">Istirahat 2 (12:00 WIB)</option>
                                <option value="Selesai Ekskul (16:00 WIB)">Selesai Ekskul (16:00 WIB)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Pemilihan Jumlah Items -->
                    <div class="pt-4 border-t border-slate-100">
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-3">Pilih Item Menu & Jumlah</label>
                        <div class="space-y-3">
                            @foreach($menus as $index => $menu)
                                <div class="flex items-center justify-between p-3.5 bg-slate-50 border border-slate-200 rounded-2xl">
                                    <div class="pr-2">
                                        <p class="font-bold text-slate-900 text-sm">{{ $menu->nama_menu }}</p>
                                        <p class="text-xs text-[#700028] font-bold">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="w-24">
                                        <input type="hidden" name="items[{{ $index }}][id]" value="{{ $menu->id }}">
                                        <input type="number" name="items[{{ $index }}][qty]" min="0" max="{{ $menu->kuota_po - $menu->terjual_po }}" value="0" class="w-full text-center bg-white border border-slate-300 rounded-xl py-1.5 text-sm font-bold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#700028]">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-[#700028] hover:bg-[#52001d] text-white font-bold py-4 rounded-xl shadow-lg shadow-pink-900/20 transition-all text-sm tracking-wide">
                        Proses & Buat Pesanan Pre-Order
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer id="lokasi" class="bg-slate-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8 text-xs text-slate-400">
            <div>
                <h4 class="text-white font-bold text-base mb-2">Wikrama Cafe & Hotel</h4>
                <p class="leading-relaxed">Unit Teaching Factory Kuliner & Perhotelan SMK Wikrama Bogor. Jl. Raya Wangun Kel. Sindangsari, Bogor Timur.</p>
            </div>
            <div>
                <h4 class="text-white font-bold text-base mb-2">Layanan Counter</h4>
                <p>Pengambilan PO: Counter Utama Hotel Wikrama</p>
                <p class="mt-1">Jam Operasional: Senin - Jumat (07.00 - 16.00 WIB)</p>
            </div>
            <div>
                <h4 class="text-white font-bold text-base mb-2">Pengembang</h4>
                <p>Sistem Kasir & Pre-Order Cafe versi Laravel 11.</p>
                <p class="mt-1 text-slate-500">© 2026 Wikrama Cafe Hotel. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
