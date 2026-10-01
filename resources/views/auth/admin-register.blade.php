<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Admin | Wikrama Cafe</title>
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
        <a href="{{ route('admin.login') }}" class="text-sm font-bold text-[#700028] hover:underline">← Kembali ke
            login</a>
        <div class="mt-8">
            <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-[#700028]">Wikrama Cafe</p>
            <h1 class="mt-2 text-2xl font-extrabold text-slate-950">Daftar Admin</h1>
            <p class="mt-2 text-sm text-slate-500">Buat akun untuk mengakses pengelolaan operasional cafe.</p>
        </div>

        @if ($errors->any())
            <div class="mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                {{ $errors->first() }}</div>
        @endif

        <form action="{{ route('admin.register.store') }}" method="POST" class="mt-6 space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-bold text-slate-700">Nama</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                    autocomplete="name"
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#700028] focus:outline-none focus:ring-2 focus:ring-[#700028]/20">
            </div>
            <div>
                <label for="email" class="block text-sm font-bold text-slate-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    autocomplete="email"
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#700028] focus:outline-none focus:ring-2 focus:ring-[#700028]/20">
            </div>
            <div>
                <label for="password" class="block text-sm font-bold text-slate-700">Password</label>
                <input id="password" name="password" type="password" required minlength="8"
                    autocomplete="new-password"
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#700028] focus:outline-none focus:ring-2 focus:ring-[#700028]/20">
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-bold text-slate-700">Konfirmasi
                    Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required minlength="8"
                    autocomplete="new-password"
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#700028] focus:outline-none focus:ring-2 focus:ring-[#700028]/20">
            </div>
            <button type="submit"
                class="w-full rounded-xl bg-[#700028] py-3.5 text-sm font-extrabold text-white transition hover:bg-[#52001d]">Buat
                Akun Admin</button>
        </form>

        <p class="mt-6 text-center text-sm text-slate-500">Sudah punya akun?
            <a href="{{ route('admin.login') }}" class="font-bold text-[#700028] hover:underline">Login di sini</a>
        </p>
    </main>
</body>

</html>
