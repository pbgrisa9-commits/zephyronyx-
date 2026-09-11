<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - {{ config('app.name', 'Zephyronyx Space') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-900 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md px-4">

        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-white">ZEPHYRONYX</h1>
            <p class="text-sm text-slate-400">SPACE Admin Panel</p>
        </div>

        <div class="bg-white rounded-xl shadow-2xl border-t-4 border-t-blue-600 overflow-hidden">
            <div class="bg-blue-50 px-6 py-4 border-b border-blue-100 text-center">
                <p class="text-sm font-semibold text-blue-800">Login Administrator</p>
                <p class="text-xs text-blue-600 mt-0.5">Khusus akses admin ZEPHYRONYX SPACE</p>
            </div>

            <div class="p-6">
                @if (session('status'))
                    <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded-lg text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded-lg text-sm">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                
                <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" required class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <button type="submit" class="w-full bg-slate-900 text-white py-2.5 rounded-lg text-sm font-semibold hover:bg-slate-800 transition-colors">
                        LOGIN SEBAGAI ADMIN
                    </button>
                </form>
            </div>
        </div>

        <p class="ext-center text-xs text-slate-500 mt-6">
            <a href="{{ route('login') }}" class="hover:text-slate-300">Bukan admin? Login sebagai pelanggan</a>
        </p>

    </div>

</body>
</html>