<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Wikrama Cafe Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .no-scrollbar {
            scrollbar-width: none;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-slate-50 text-slate-800 antialiased">

    <x-siswa.sidebar :student="$student" />
    <div id="sidebarBackdrop" data-close-sidebar class="hidden fixed inset-0 z-40 bg-slate-900/50 lg:hidden"></div>

    <div class="@yield('wrapper', 'lg:ml-[260px]') min-h-screen">
        <header class="sticky top-0 z-20 bg-slate-50/90 backdrop-blur border-b border-slate-200/70">
            <!-- tablet & mobile: burger + sapaan -->
            <div class="lg:hidden flex items-center justify-between gap-3 px-4 h-14">
                <div class="flex items-center gap-3 min-w-0">
                    <button id="burger" type="button" aria-label="Buka menu" aria-controls="sidebar"
                        class="w-10 h-10 shrink-0 rounded-xl bg-white border border-slate-200 text-slate-700 flex items-center justify-center active:scale-95 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div class="min-w-0">
                        <p class="text-sm font-extrabold text-slate-900 truncate">Halo,
                            {{ data_get($student, 'nama', data_get($student, 'name', 'Siswa')) }}</p>
                        <p class="text-[11px] text-slate-500 truncate">{{ data_get($student, 'kelas', '-') }}</p>
                    </div>
                </div>
                <span
                    class="w-9 h-9 shrink-0 rounded-full bg-[#700028] text-white text-xs font-bold flex items-center justify-center">{{ data_get($student, 'inisial', strtoupper(substr(data_get($student, 'name', 'S'), 0, 1))) }}</span>
            </div>

            @yield('topbar')
        </header>

        @yield('content')
    </div>

    <script>
        // Sidebar off-canvas untuk tablet & mobile
        (() => {
            const sb = document.getElementById('sidebar'),
                bd = document.getElementById('sidebarBackdrop');
            const open = () => {
                sb.classList.remove('-translate-x-full');
                bd.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            };
            const close = () => {
                sb.classList.add('-translate-x-full');
                bd.classList.add('hidden');
                document.body.style.overflow = '';
            };
            document.getElementById('burger').addEventListener('click', open);
            document.querySelectorAll('[data-close-sidebar]').forEach(el => el.addEventListener('click', close));
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') close();
            });
            window.matchMedia('(min-width: 1024px)').addEventListener('change', e => {
                if (e.matches) close();
            });
        })();

        // Badge nomor antrian pesanan aktif (diisi halaman status)
        try {
            const o = JSON.parse(localStorage.getItem('wc_last_order') || 'null');
            if (o && o.day === new Date().toDateString()) {
                const n = document.getElementById('navMyOrderNo');
                n.textContent = o.antrian;
                n.classList.remove('hidden');
            }
        } catch {}
    </script>
    @stack('scripts')
</body>

</html>
