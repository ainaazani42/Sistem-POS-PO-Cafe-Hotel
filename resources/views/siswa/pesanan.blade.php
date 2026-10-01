@extends('siswa.layout')

@section('title', 'Pesanan Saya')

@section('topbar')
    <div class="px-4 lg:px-8 pb-3 lg:py-4">
        <h1 class="text-lg font-extrabold text-slate-900">Pesanan Saya</h1>
        <p class="hidden lg:block text-xs text-slate-500">Riwayat Pre-Order kamu. Ketuk pesanan untuk melihat tiket & nomor antrian.</p>
    </div>
@endsection

@section('content')
    <main class="px-4 lg:px-8 py-5 pb-10 grid grid-cols-1 gap-5 xl:grid-cols-[320px_minmax(0,1fr)] items-start">

        <!-- Profil -->
        <aside class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 sm:p-6">
            <div class="flex xl:flex-col items-center xl:text-center gap-4">
                <span class="w-20 h-20 xl:w-24 xl:h-24 shrink-0 rounded-3xl bg-gradient-to-br from-[#700028] to-[#4a0019] text-white text-2xl xl:text-3xl font-extrabold flex items-center justify-center ring-4 ring-pink-100">{{ $student['inisial'] }}</span>
                <div class="min-w-0">
                    <h2 class="text-lg xl:text-xl font-extrabold text-slate-900 truncate">{{ $student['nama'] }}</h2>
                    <span class="inline-block mt-1.5 text-[11px] font-bold text-[#700028] bg-pink-100 rounded-full px-3 py-1">Siswa • {{ $student['kelas'] }}</span>
                    <p class="text-xs text-slate-500 mt-2">NIS: {{ $student['nis'] }} • SMK Wikrama Bogor</p>
                </div>
            </div>

            <dl class="mt-5 pt-5 border-t border-slate-100 grid sm:grid-cols-3 xl:grid-cols-1 gap-3 text-sm">
                <div class="bg-slate-50 rounded-xl p-3.5">
                    <dt class="text-[11px] font-semibold text-slate-500">Nomor WhatsApp</dt>
                    <dd class="font-bold text-slate-900 mt-0.5">{{ $student['wa'] }}</dd>
                </div>
                <div class="bg-slate-50 rounded-xl p-3.5">
                    <dt class="text-[11px] font-semibold text-slate-500">Metode Transaksi</dt>
                    <dd class="font-bold text-slate-900 mt-0.5">TUNAI di Kasir (saat pickup)</dd>
                </div>
                <div class="bg-slate-50 rounded-xl p-3.5">
                    <dt class="text-[11px] font-semibold text-slate-500">Pesanan Aktif</dt>
                    <dd class="font-bold text-slate-900 mt-0.5">{{ $aktif }} pesanan</dd>
                </div>
            </dl>

            <div class="mt-5 grid gap-2.5">
                <a href="{{ route('siswa.dashboard') }}" class="bg-[#700028] hover:bg-[#52001d] text-white font-bold text-sm text-center py-3 rounded-xl shadow-lg shadow-pink-900/20 transition">Pesan Menu Lagi</a>
                <a href="{{ route('landing') }}" class="border border-red-200 text-red-600 hover:bg-red-50 font-bold text-sm text-center py-3 rounded-xl transition">Keluar / Logout</a>
            </div>
        </aside>

        <!-- Riwayat -->
        <section class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="px-5 sm:px-6 py-4 border-b border-slate-100 flex items-center justify-between gap-3">
                <div>
                    <h2 class="font-extrabold text-slate-900">Riwayat Pre-Order</h2>
                    <p class="text-xs text-slate-500">{{ count($riwayat) }} pesanan tercatat</p>
                </div>
                <a href="{{ route('siswa.lacak') }}" class="shrink-0 text-xs font-bold text-[#700028] bg-pink-50 hover:bg-pink-100 px-3.5 py-2 rounded-lg transition">Lacak Pesanan</a>
            </div>

            @if (count($riwayat) === 0)
                <div class="text-center px-6 py-14">
                    <div class="text-5xl mb-3">🧾</div>
                    <p class="font-bold text-slate-900">Belum ada riwayat pesanan</p>
                    <p class="text-sm text-slate-500 mt-1">Pesanan Pre-Order kamu akan muncul di sini.</p>
                    <a href="{{ route('siswa.dashboard') }}" class="inline-block mt-5 bg-[#700028] text-white text-sm font-bold px-6 py-3 rounded-xl">Pesan Sekarang</a>
                </div>
            @endif

            @if (count($riwayat) > 0)
                <!-- tablet/desktop: tabel -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-[11px] font-bold uppercase tracking-wide text-slate-500 bg-slate-50">
                                <th class="px-6 py-3">Tiket</th>
                                <th class="px-3 py-3">Tanggal</th>
                                <th class="px-3 py-3">Menu</th>
                                <th class="px-3 py-3">Jadwal Pickup</th>
                                <th class="px-3 py-3 text-right">Total Tunai</th>
                                <th class="px-6 py-3 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($riwayat as $r)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="px-6 py-4 align-top">
                                        <a href="{{ $r['url'] }}" class="font-extrabold text-[#700028] hover:underline">{{ $r['antrian'] }}</a>
                                        <p class="text-[11px] text-slate-500 whitespace-nowrap">{{ $r['kode'] }}</p>
                                    </td>
                                    <td class="px-3 py-4 align-top text-slate-600">{{ $r['tanggal'] }}</td>
                                    <td class="px-3 py-4 align-top text-slate-800 max-w-[220px]">{{ $r['menu'] }}</td>
                                    <td class="px-3 py-4 align-top"><span class="inline-block text-xs font-semibold bg-slate-100 text-slate-700 rounded-lg px-2.5 py-1.5">{{ $r['jadwal'] }}</span></td>
                                    <td class="px-3 py-4 align-top text-right font-extrabold text-slate-900 whitespace-nowrap">Rp {{ number_format($r['total'], 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 align-top text-center"><span class="inline-block text-[11px] font-bold rounded-full px-3 py-1.5 whitespace-nowrap {{ $r['status_class'] }}">{{ $r['status_label'] }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- mobile: kartu -->
                <ul class="md:hidden divide-y divide-slate-100">
                    @foreach ($riwayat as $r)
                        <li>
                            <a href="{{ $r['url'] }}" class="block px-5 py-4 active:bg-slate-50">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <p class="font-extrabold text-[#700028]">{{ $r['antrian'] }} <span class="text-[11px] font-semibold text-slate-400">{{ $r['kode'] }}</span></p>
                                        <p class="text-[11px] text-slate-500 mt-0.5">{{ $r['tanggal'] }}</p>
                                    </div>
                                    <span class="shrink-0 text-[11px] font-bold rounded-full px-3 py-1.5 {{ $r['status_class'] }}">{{ $r['status_label'] }}</span>
                                </div>
                                <p class="text-sm text-slate-800 mt-2.5">{{ $r['menu'] }}</p>
                                <div class="flex items-center justify-between gap-3 mt-3">
                                    <span class="text-[11px] font-semibold bg-slate-100 text-slate-700 rounded-lg px-2.5 py-1.5">🕘 {{ $r['jadwal'] }}</span>
                                    <span class="font-extrabold text-slate-900">Rp {{ number_format($r['total'], 0, ',', '.') }}</span>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>
    </main>
@endsection
