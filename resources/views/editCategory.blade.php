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
        label{
            color: #fff;
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
        <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Update Category</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- A Product Form -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 p-6">
                <form action="{{ url('updateCategory', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category Name</label>
                        <input type="text" value="{{ $category->name }}" id="name" name="name" required class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>