<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-4xl font-bold">Welcome to the Dashboard</h1>
        <p class="mt-4">You are successfully logged in.</p>
        <h1 class="text-4xl font-bold">Welcome to the Dashboard</h1>
<p class="mt-4">You are successfully logged in.</p>

<p>Login status: {{ Auth::check() ? 'YES' : 'NO' }}</p>

    </div>
</body>
</html>
