<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CubeRoute Store</title>
    
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .impact-font {
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900">
    <!-- Header/Navigation Bar -->
    <header class="sticky top-0 z-10 bg-white dark:bg-gray-800 shadow-sm">
        <div class="container mx-auto flex justify-between items-center p-4">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="text-2xl font-bold impact-font text-red-600">
                CubeRoute Ecommerce
            </a>
            
            <!-- Navigation Links -->
            @if (Route::has('login'))
                <nav class="flex space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-300 hover:underline">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm text-gray-700 dark:text-gray-300 hover:underline">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Manage Store</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- C.R.U.D Buttons -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Manage Products</h3>
                <div class="space-y-2">
                    <a href="{{ url('addProduct') }}" class="block bg-green-600 text-white text-center py-2 rounded hover:bg-green-700 transition">Add New Product</a>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Manage Categories</h3>
                <div class="space-y-2">
                    <a href="{{ url('categories') }}" class="block bg-green-600 text-white text-center py-2 rounded hover:bg-green-700 transition">Manage Categories</a>
                </div>
            </div>
    </main>
</body>
</html>