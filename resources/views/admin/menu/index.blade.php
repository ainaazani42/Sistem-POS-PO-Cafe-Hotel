@extends('admin.layout')

@section('title', 'Manajemen Menu')
@section('heading', 'Manajemen Menu')
@section('subheading', 'Atur kuota PO harian, batas porsi per pesanan, dan visibilitas menu di aplikasi siswa.')

@section('actions')
    <button type="button" data-open-add class="bg-[#700028] hover:bg-[#52001d] text-white text-xs sm:text-sm font-bold pl-3 pr-4 py-2.5 rounded-xl shadow-lg shadow-pink-900/20 flex items-center gap-1.5 transition active:scale-95">
        <span class="text-lg leading-none">+</span> <span>Tambah Menu</span>
    </button>
@endsection

@section('content')
    <main class="px-4 lg:px-8 py-5 pb-12 space-y-5">

        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-800 text-sm font-semibold px-4 py-3">✓ {{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 text-red-700 text-sm font-semibold px-4 py-3">{{ $errors->first() }}</div>
        @endif

        <!-- Ringkasan -->
        <section class="grid grid-cols-2 xl:grid-cols-4 gap-3 sm:gap-4">
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 sm:p-5">
                <p class="text-xs font-semibold text-slate-500">Menu Aktif Dijual</p>
                <p class="mt-2 text-2xl font-extrabold text-slate-900">{{ $stats['aktif'] }}<span class="text-sm font-semibold text-slate-400"> / {{ $stats['total'] }}</span></p>
                <p class="mt-1 text-[11px] text-slate-500">{{ $stats['nonaktif'] }} menu nonaktif</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 sm:p-5">
                <p class="text-xs font-semibold text-slate-500">Total Kuota PO</p>
                <p class="mt-2 text-2xl font-extrabold text-slate-900">{{ $stats['kuota'] }}<span class="text-sm font-semibold text-slate-400"> porsi</span></p>
                <p class="mt-1 text-[11px] text-slate-500">Seluruh menu aktif & nonaktif</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 sm:p-5">
                <p class="text-xs font-semibold text-slate-500">Terjual via PO</p>
                <p class="mt-2 text-2xl font-extrabold text-[#700028]">{{ $stats['terjual'] }}<span class="text-sm font-semibold text-slate-400"> porsi</span></p>
                <p class="mt-1 text-[11px] text-slate-500">Sisa {{ $stats['kuota'] - $stats['terjual'] }} porsi</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 sm:p-5">
                <p class="text-xs font-semibold text-slate-500">Sold Out</p>
                <p class="mt-2 text-2xl font-extrabold {{ $stats['habis'] > 0 ? 'text-red-600' : 'text-emerald-600' }}">{{ $stats['habis'] }}<span class="text-sm font-semibold text-slate-400"> menu</span></p>
                <p class="mt-1 text-[11px] text-slate-500">{{ $stats['habis'] > 0 ? 'Perlu tambah kuota' : 'Semua masih tersedia' }}</p>
            </div>
        </section>

        <!-- Katalog -->
        <section class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="p-4 sm:p-5 border-b border-slate-100 space-y-3">
                <div>
                    <h2 class="font-extrabold text-slate-900">Katalog Menu & Kontrol Kuota PO</h2>
                    <p class="text-xs text-slate-500">Perubahan langsung tampil di katalog siswa.</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="relative sm:w-72">
                        <svg class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.3-4.3M17 10a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input id="menuSearch" type="search" placeholder="Cari menu…" class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                    </div>
                    <div class="flex gap-2 overflow-x-auto no-scrollbar">
                        @foreach ([['semua', 'Semua'], ['makanan', 'Makanan'], ['minuman', 'Minuman'], ['snack', 'Snack']] as $i => [$val, $label])
                            <button type="button" data-filter="{{ $val }}" class="shrink-0 px-4 py-2 rounded-xl border text-xs font-bold transition {{ $i === 0 ? 'bg-[#700028] text-white border-[#700028]' : 'bg-white text-slate-700 border-slate-200 hover:border-slate-300' }}">{{ $label }}</button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- header kolom (desktop) -->
            <div class="hidden md:grid grid-cols-[minmax(0,2.2fr)_1fr_1.3fr_1.3fr_1.1fr_auto] gap-4 px-5 py-3 bg-slate-50 text-[11px] font-bold uppercase tracking-wide text-slate-500">
                <span>Menu</span><span>Harga</span><span>Kuota PO Harian</span><span>Maks / Pesanan</span><span>Status</span><span class="text-right">Aktif & Aksi</span>
            </div>

            <div id="menuRows" class="divide-y divide-slate-100">
                @foreach ($menus as $menu)
                    <div data-row data-kat="{{ $menu->kategori }}" data-nama="{{ $menu->nama_menu }}" data-id="{{ $menu->id }}" data-harga="{{ $menu->harga }}" data-kuota="{{ $menu->kuota_po }}" data-maks="{{ $menu->maks_per_order }}" data-url="{{ route('admin.menu.update', $menu->id) }}" class="grid grid-cols-2 md:grid-cols-[minmax(0,2.2fr)_1fr_1.3fr_1.3fr_1.1fr_auto] gap-x-4 gap-y-3 items-center px-5 py-4 {{ $menu->is_active ? '' : 'bg-slate-50/80' }}">

                        <div class="col-span-2 md:col-span-1 flex items-center gap-3 min-w-0 {{ $menu->is_active ? '' : 'opacity-50' }}">
                            <span class="w-11 h-11 shrink-0 rounded-xl flex items-center justify-center text-xl {{ $menu->kategori === 'minuman' ? 'bg-sky-100' : ($menu->kategori === 'snack' ? 'bg-pink-100' : 'bg-orange-100') }}">{{ $menu->kategori === 'minuman' ? '🥤' : ($menu->kategori === 'snack' ? '🍟' : '🍛') }}</span>
                            <span class="min-w-0">
                                <span class="block text-sm font-bold text-slate-900 truncate">{{ $menu->nama_menu }}</span>
                                <span class="inline-block mt-0.5 text-[10px] font-bold uppercase tracking-wide text-slate-500">{{ $menu->kategori }}</span>
                            </span>
                        </div>

                        <div class="{{ $menu->is_active ? '' : 'opacity-50' }}">
                            <span class="md:hidden block text-[10px] font-bold uppercase text-slate-400 mb-1">Harga</span>
                            <span class="text-sm font-extrabold text-slate-900">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                        </div>

                        <div class="md:hidden {{ $menu->is_active ? '' : 'opacity-50' }}">
                            <span class="md:hidden block text-[10px] font-bold uppercase text-slate-400 mb-1">Status</span>
                            @if (($menu->kuota_po - $menu->terjual_po) <= 0)
                                <span class="inline-block text-[11px] font-bold rounded-full px-2.5 py-1 bg-red-100 text-red-700 md:hidden">Sold out ({{ $menu->terjual_po }}/{{ $menu->kuota_po }})</span>
                            @endif
                            @if (($menu->kuota_po - $menu->terjual_po) > 0)
                                <span class="inline-block text-[11px] font-bold rounded-full px-2.5 py-1 md:hidden {{ ($menu->kuota_po - $menu->terjual_po) <= 5 ? 'bg-orange-100 text-orange-700' : 'bg-emerald-100 text-emerald-700' }}">Sisa {{ ($menu->kuota_po - $menu->terjual_po) }} · terjual {{ $menu->terjual_po }}</span>
                            @endif
                        </div>

                        <form action="{{ route('admin.menu.quota', $menu->id) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <div class="w-full">
                                <span class="md:hidden block text-[10px] font-bold uppercase text-slate-400 mb-1">Kuota PO</span>
                                <div class="flex items-center gap-2">
                                    <input type="number" name="kuota_po" min="0" value="{{ $menu->kuota_po }}" data-orig="{{ $menu->kuota_po }}" aria-label="Kuota PO {{ $menu->nama_menu }}" class="w-full min-w-0 px-3 py-2 rounded-lg border border-slate-200 bg-slate-50 text-sm font-bold text-center focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                                    <button type="submit" disabled aria-label="Simpan kuota" class="save-btn shrink-0 w-9 h-9 rounded-lg bg-slate-100 text-slate-300 font-bold transition disabled:cursor-not-allowed">✓</button>
                                </div>
                            </div>
                        </form>

                        <form action="{{ route('admin.menu.maxOrder', $menu->id) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <div class="w-full">
                                <span class="md:hidden block text-[10px] font-bold uppercase text-slate-400 mb-1">Maks / pesanan</span>
                                <div class="flex items-center gap-2">
                                    <input type="number" name="maks_per_order" min="1" value="{{ $menu->maks_per_order }}" data-orig="{{ $menu->maks_per_order }}" aria-label="Maksimal per pesanan {{ $menu->nama_menu }}" class="w-full min-w-0 px-3 py-2 rounded-lg border border-slate-200 bg-slate-50 text-sm font-bold text-center focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                                    <button type="submit" disabled aria-label="Simpan batas per pesanan" class="save-btn shrink-0 w-9 h-9 rounded-lg bg-slate-100 text-slate-300 font-bold transition disabled:cursor-not-allowed">✓</button>
                                </div>
                            </div>
                        </form>

                        <div class="hidden md:block {{ $menu->is_active ? '' : 'opacity-50' }}">
                            @if (($menu->kuota_po - $menu->terjual_po) <= 0)
                                <span class="inline-block text-[11px] font-bold rounded-full px-2.5 py-1 bg-red-100 text-red-700">Sold out</span>
                            @endif
                            @if (($menu->kuota_po - $menu->terjual_po) > 0)
                                <span class="inline-block text-[11px] font-bold rounded-full px-2.5 py-1 {{ ($menu->kuota_po - $menu->terjual_po) <= 5 ? 'bg-orange-100 text-orange-700' : 'bg-emerald-100 text-emerald-700' }}">Sisa {{ ($menu->kuota_po - $menu->terjual_po) }}</span>
                            @endif
                            <p class="text-[11px] text-slate-500 mt-1">Terjual {{ $menu->terjual_po }} / {{ $menu->kuota_po }}</p>
                        </div>

                        <div class="col-span-2 md:col-span-1 flex items-center justify-between md:justify-end gap-2">
                            <form action="{{ route('admin.menu.toggle', $menu->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" role="switch" aria-checked="{{ $menu->is_active ? 'true' : 'false' }}" aria-label="Aktifkan {{ $menu->nama_menu }}" class="relative w-12 h-7 rounded-full transition {{ $menu->is_active ? 'bg-emerald-500' : 'bg-slate-300' }}">
                                    <span class="absolute top-0.5 w-6 h-6 bg-white rounded-full shadow transition-all {{ $menu->is_active ? 'left-[22px]' : 'left-0.5' }}"></span>
                                </button>
                                <span class="md:hidden text-[11px] font-bold {{ $menu->is_active ? 'text-emerald-700' : 'text-slate-500' }}">{{ $menu->is_active ? 'Tampil di katalog' : 'Disembunyikan' }}</span>
                            </form>
                            <div class="flex items-center gap-1.5">
                                <button type="button" data-edit aria-label="Edit {{ $menu->nama_menu }}" class="h-9 px-3 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition">✏️ <span class="md:hidden">Edit</span></button>
                                <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Hapus menu {{ $menu->nama_menu }}? Tindakan ini tidak bisa dibatalkan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" aria-label="Hapus {{ $menu->nama_menu }}" class="h-9 px-3 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 text-xs font-bold transition">🗑️ <span class="md:hidden">Hapus</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($menus->isEmpty())
                <div class="text-center px-6 py-14">
                    <div class="text-5xl mb-3">🍽️</div>
                    <p class="font-bold text-slate-900">Belum ada menu</p>
                    <button type="button" data-open-add class="mt-4 bg-[#700028] text-white text-sm font-bold px-6 py-3 rounded-xl">Tambah Menu Pertama</button>
                </div>
            @endif
            <div id="menuEmpty" class="hidden text-center px-6 py-12 text-sm text-slate-500">Tidak ada menu yang cocok.</div>
        </section>
    </main>

    <!-- Modal tambah menu -->
    <div id="addModal" class="hidden fixed inset-0 z-[60]">
        <div data-close-add class="absolute inset-0 bg-slate-900/50"></div>
        <form id="menuForm" action="{{ route('admin.menu.store') }}" method="POST" data-store-url="{{ route('admin.menu.store') }}" class="absolute bottom-0 inset-x-0 sm:inset-auto sm:top-1/2 sm:left-1/2 sm:-translate-x-1/2 sm:-translate-y-1/2 sm:w-[440px] max-h-[92vh] overflow-y-auto bg-white rounded-t-3xl sm:rounded-3xl shadow-2xl p-6 space-y-4">
            @csrf
            <input type="hidden" name="_method" value="PUT" id="methodField" disabled>
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h2 id="modalTitle" class="text-lg font-extrabold text-slate-900">Tambah Menu Baru</h2>
                    <p id="modalSub" class="text-xs text-slate-500">Menu langsung tampil di katalog siswa.</p>
                </div>
                <button type="button" data-close-add aria-label="Tutup" class="w-9 h-9 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center">✕</button>
            </div>
            <div>
                <label for="nama_menu" class="block text-xs font-bold text-slate-700 mb-1.5">Nama Menu</label>
                <input id="nama_menu" name="nama_menu" type="text" required maxlength="255" placeholder="Contoh: Nasi Bakar Cumi Pedas" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label for="kategori" class="block text-xs font-bold text-slate-700 mb-1.5">Kategori</label>
                    <select id="kategori" name="kategori" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                        <option value="makanan">Makanan</option>
                        <option value="minuman">Minuman</option>
                        <option value="snack">Snack</option>
                    </select>
                </div>
                <div>
                    <label for="harga" class="block text-xs font-bold text-slate-700 mb-1.5">Harga (Rp)</label>
                    <input id="harga" name="harga" type="number" min="0" required placeholder="16000" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                </div>
                <div>
                    <label for="kuota_po" class="block text-xs font-bold text-slate-700 mb-1.5">Kuota PO Harian</label>
                    <input id="kuota_po" name="kuota_po" type="number" min="0" required placeholder="25" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                </div>
                <div>
                    <label for="maks_per_order" class="block text-xs font-bold text-slate-700 mb-1.5">Maks / Pesanan</label>
                    <input id="maks_per_order" name="maks_per_order" type="number" min="1" value="5" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-base sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#700028]/30 focus:border-[#700028]">
                </div>
            </div>
            <button type="submit" class="w-full bg-[#700028] hover:bg-[#52001d] text-white font-bold text-sm py-3.5 rounded-xl shadow-lg shadow-pink-900/20 transition"><span id="modalSubmit">Simpan Menu</span></button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Filter kategori + pencarian
        let kat = 'semua', q = '';
        const rows = [...document.querySelectorAll('[data-row]')];
        function applyFilter() {
            let shown = 0;
            rows.forEach(r => {
                const ok = (kat === 'semua' || r.dataset.kat === kat) && r.dataset.nama.toLowerCase().includes(q);
                r.classList.toggle('hidden', !ok); if (ok) shown++;
            });
            document.getElementById('menuEmpty').classList.toggle('hidden', shown > 0 || rows.length === 0);
        }
        document.getElementById('menuSearch').addEventListener('input', e => { q = e.target.value.toLowerCase(); applyFilter(); });
        document.querySelectorAll('[data-filter]').forEach(b => b.addEventListener('click', () => {
            kat = b.dataset.filter;
            document.querySelectorAll('[data-filter]').forEach(x => {
                const on = x === b;
                ['bg-[#700028]', 'text-white', 'border-[#700028]'].forEach(c => x.classList.toggle(c, on));
                ['bg-white', 'text-slate-700', 'border-slate-200'].forEach(c => x.classList.toggle(c, !on));
            });
            applyFilter();
        }));

        // Tombol simpan aktif hanya jika nilai berubah
        document.querySelectorAll('input[data-orig]').forEach(inp => inp.addEventListener('input', () => {
            const btn = inp.closest('form').querySelector('.save-btn'), changed = inp.value !== inp.dataset.orig;
            btn.disabled = !changed;
            ['bg-[#700028]', 'text-white'].forEach(c => btn.classList.toggle(c, changed));
            ['bg-slate-100', 'text-slate-300'].forEach(c => btn.classList.toggle(c, !changed));
        }));

        // Modal tambah / edit menu
        const modal = document.getElementById('addModal'), form = document.getElementById('menuForm'), methodField = document.getElementById('methodField');
        const fields = { nama_menu: 'nama', kategori: 'kat', harga: 'harga', kuota_po: 'kuota', maks_per_order: 'maks' };
        function openForm(row) {
            const edit = !!row;
            form.action = edit ? row.dataset.url : form.dataset.storeUrl;
            methodField.disabled = !edit;
            document.getElementById('modalTitle').textContent = edit ? 'Edit Menu' : 'Tambah Menu Baru';
            document.getElementById('modalSub').textContent = edit ? 'Perubahan langsung tampil di katalog siswa.' : 'Menu langsung tampil di katalog siswa.';
            document.getElementById('modalSubmit').textContent = edit ? 'Simpan Perubahan' : 'Simpan Menu';
            Object.entries(fields).forEach(([name, key]) => {
                form.elements[name].value = edit ? row.dataset[key] : (name === 'maks_per_order' ? 5 : (name === 'kategori' ? 'makanan' : ''));
            });
            modal.classList.remove('hidden');
            form.elements.nama_menu.focus();
        }
        document.querySelectorAll('[data-open-add]').forEach(b => b.addEventListener('click', () => openForm(null)));
        document.querySelectorAll('[data-edit]').forEach(b => b.addEventListener('click', () => openForm(b.closest('[data-row]'))));
        document.querySelectorAll('[data-close-add]').forEach(b => b.addEventListener('click', () => modal.classList.add('hidden')));
        document.addEventListener('keydown', e => { if (e.key === 'Escape') modal.classList.add('hidden'); });
    </script>
@endpush
