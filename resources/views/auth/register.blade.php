    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-r from-purple-500 via-purple-600 to-indigo-700">
    <div 
        x-data="{ show: false }" 
        x-init="setTimeout(() => show = true, 200)" 
        x-show="show"
        x-transition:enter="transition ease-out duration-700" 
        x-transition:enter-start="opacity-0 -translate-y-10" 
        x-transition:enter-end="opacity-100 translate-y-0"
        class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md"
    >
        <h1 class="text-3xl font-bold text-center text-purple-700 mb-6">Create Account</h1>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 text-gray-600">Name</label>
                <input type="text" name="name" required class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-purple-500">
            </div>

            <div>
                <label class="block mb-1 text-gray-600">Email</label>
                <input type="email" name="email" required class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-purple-500">
            </div>

            <div>
                <label class="block mb-1 text-gray-600">Password</label>
                <input type="password" name="password" required class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-purple-500">
            </div>

            <div>
                <label class="block mb-1 text-gray-600">Confirm Password</label>
                <input type="password" name="password_confirmation" required class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-purple-500">
            </div>

            <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-lg font-semibold transition">
                Register
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Already have an account?
            <a href="{{ route('login') }}" class="text-purple-600 hover:underline font-semibold">Click here</a>
        </p>
    </div>

</body>
</html>
