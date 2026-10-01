<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Wikrama Cafe</title>
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

    <!-- Sidebar (off-canvas di tablet & mobile) -->
    <aside id="sidebar"
        class="fixed inset-y-0 left-0 w-[260px] bg-[#1e2540] text-slate-300 flex flex-col z-50 -translate-x-full lg:translate-x-0 transition-transform duration-300">
        <div class="px-5 pt-6 pb-5 border-b border-white/10">
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-3 min-w-0">
                    <span
                        class="w-10 h-10 shrink-0 bg-[#700028] text-white rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 3v7a2 2 0 002 2v9M10 3v7M8 3v7M18 21V3c-2 2-3 5-3 8h3" />
                        </svg>
                    </span>
                    <span class="min-w-0">
                        <span class="block font-extrabold text-white leading-tight truncate">Wikrama Cafe Hotel</span>
                        <span class="block text-[11px] text-slate-400">Panel Admin • Perhotelan</span>
                    </span>
                </div>
                <button type="button" data-close-sidebar aria-label="Tutup menu"
                    class="lg:hidden w-8 h-8 shrink-0 rounded-lg bg-white/10 text-slate-200 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M6 6l12 12M18 6L6 18" />
                    </svg>
                </button>
            </div>
            <div class="mt-5 flex items-center gap-3 bg-white/5 border border-white/10 rounded-xl p-3">
                <span
                    class="w-10 h-10 shrink-0 rounded-full bg-orange-500 text-white text-sm font-bold flex items-center justify-center">SD</span>
                <span class="min-w-0">
                    <span class="block text-sm font-bold text-white truncate">Supervisor Dapur</span>
                    <span class="block text-[11px] text-slate-400 truncate">Admin Wikrama Hotel Hub</span>
                </span>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto px-3 py-5 space-y-1 text-sm font-semibold">
            <p class="px-3 pb-2 text-[10px] font-bold tracking-widest text-slate-500">OPERASIONAL CAFE</p>
            <a href="{{ route('admin.menu.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-xl transition {{ request()->routeIs('admin.menu.index') ? 'bg-[#700028] text-white shadow-lg shadow-black/20' : 'hover:bg-white/5' }}">
                <span class="w-5 text-center">🍽️</span> Manajemen Menu
            </a>
            <a href="{{ route('admin.po.index') }}"
                class="flex items-center justify-between gap-3 px-3 py-3 rounded-xl transition {{ request()->routeIs('admin.po.index') ? 'bg-[#700028] text-white shadow-lg shadow-black/20' : 'hover:bg-white/5' }}">
                <span class="flex items-center gap-3"><span class="w-5 text-center">🔔</span> Live Order</span>
                @if ($pendingCount > 0)
                    <span
                        class="text-[10px] font-bold bg-orange-500 text-white px-2 py-0.5 rounded-full">{{ $pendingCount }}</span>
                @endif
            </a>
        </nav>

        <div class="px-3 pb-5 border-t border-white/10 pt-4">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center text-xs font-bold text-[#f3b8c8] bg-white/5 hover:bg-white/10 rounded-xl py-3 transition">Keluar</button>
            </form>
        </div>
    </aside>
    <div id="sidebarBackdrop" data-close-sidebar class="hidden fixed inset-0 z-40 bg-slate-900/50 lg:hidden"></div>

    <div class="lg:ml-[260px] min-h-screen">
        <header class="sticky top-0 z-30 bg-slate-50/90 backdrop-blur border-b border-slate-200/70">
            <div class="flex items-center justify-between gap-3 px-4 lg:px-8 h-16">
                <div class="flex items-center gap-3 min-w-0">
                    <button id="burger" type="button" aria-label="Buka menu" aria-controls="sidebar"
                        class="lg:hidden w-10 h-10 shrink-0 rounded-xl bg-white border border-slate-200 text-slate-700 flex items-center justify-center active:scale-95 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div class="min-w-0">
                        <h1 class="text-base sm:text-lg font-extrabold text-slate-900 truncate">@yield('heading')</h1>
                        <p class="hidden sm:block text-xs text-slate-500 truncate">@yield('subheading')</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 shrink-0">@yield('actions')</div>
            </div>
        </header>

        @yield('content')
    </div>

    <script>
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
    </script>
    @stack('scripts')
</body>

</html>
