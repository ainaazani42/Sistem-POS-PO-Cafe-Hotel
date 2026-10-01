<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wikrama Cafe Hotel - Pre-Order & Kasir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        section[id] { scroll-margin-top: 5rem; }
    </style>
</head>
<body class="bg-white text-slate-800 antialiased">

    <x-landing.navbar />
    <x-landing.hero />
    <x-landing.menu-unggulan :featured="$featured" />
    <x-landing.alur-preorder />
    <x-landing.lacak />
    <x-landing.akses />
    <x-landing.lokasi />
    <x-landing.footer />
    <x-landing.cart-fab />
    <x-landing.active-order />
    <x-cart.drawer />
    <x-cart.scripts :menus="$menus" />

</body>
</html>
