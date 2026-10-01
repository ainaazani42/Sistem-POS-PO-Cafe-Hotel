<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Wikrama Cafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-950 text-slate-900 flex items-center justify-center p-4">
    <main class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-6 sm:p-8">
        <a href="{{ route('landing') }}" class="text-sm font-bold text-[#700028] hover:underline">← Beranda</a>
        <div class="mt-8">
            <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-[#700028]">Wikrama Cafe</p>
            <h1 class="mt-2 text-2xl font-extrabold text-slate-950">Login Admin</h1>
            <p class="mt-2 text-sm text-slate-500">Kelola menu, kuota PO, dan pesanan dari dashboard admin.</p>
        </div>

        @if ($errors->any())
            <div class="mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                {{ $errors->first() }}</div>
        @endif

        <form action="{{ route('admin.login.store') }}" method="POST" class="mt-6 space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-bold text-slate-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    autocomplete="email"
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#700028] focus:outline-none focus:ring-2 focus:ring-[#700028]/20">
            </div>
            <div>
                <label for="password" class="block text-sm font-bold text-slate-700">Password</label>
                <input id="password" name="password" type="password" required autocomplete="current-password"
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#700028] focus:outline-none focus:ring-2 focus:ring-[#700028]/20">
            </div>
            <button type="submit"
                class="w-full rounded-xl bg-[#700028] py-3.5 text-sm font-extrabold text-white transition hover:bg-[#52001d]">Masuk
                sebagai Admin</button>
        </form>

        <p class="mt-6 text-center text-sm text-slate-500">Belum punya akun admin?
            <a href="{{ route('admin.register') }}" class="font-bold text-[#700028] hover:underline">Daftar di sini</a>
        </p>
    </main>
</body>

</html>
