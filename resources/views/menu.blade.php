<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Pre-Order - Wikrama Cafe Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .no-scrollbar { scrollbar-width: none; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

    <x-menu.header />

    <main class="max-w-6xl mx-auto px-4 sm:px-6 pb-28 md:pb-12">
        <x-menu.toolbar />

        <div id="menuGrid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5 mt-2"></div>

        <div id="emptyMenu" class="hidden text-center py-20">
            <div class="text-5xl mb-3">🍽️</div>
            <p class="font-bold text-slate-900">Menu tidak ditemukan</p>
            <p class="text-sm text-slate-500 mt-1">Coba kata kunci atau kategori lain.</p>
        </div>
    </main>

    <x-menu.cart-bar />
    <x-cart.drawer />

    <x-cart.scripts :menus="$menus" />
</body>
</html>
