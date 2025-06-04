<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-r from-purple-500 via-purple-600 to-indigo-700">

    <div 
        x-data="{ show: false }" 
        x-init="setTimeout(() => show = true, 200)" 
        x-show="show"
        x-transition:enter="transition ease-out duration-700" 
        x-transition:enter-start="opacity-0 translate-y-10" 
        x-transition:enter-end="opacity-100 translate-y-0"
        class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md"
    >
        <h1 class="text-3xl font-bold text-center text-purple-700 mb-6">Welcome Back!</h1>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="text-sm list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <div>
                <label class="block mb-1 text-gray-600" for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    required 
                    class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500"
                    value="{{ old('email') }}"
                >
            </div>

            <div>
                <label class="block mb-1 text-gray-600" for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required 
                    class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500"
                >
            </div>

            <button 
                type="submit" 
                class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-lg font-semibold transition duration-200"
            >
                Login
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-purple-600 hover:underline font-semibold">Register disini</a>
        </p>
    </div>

</body>
</html>
