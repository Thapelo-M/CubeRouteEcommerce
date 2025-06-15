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
        <h2 class="text-2xl font-bold mb-6 text-white-900 dark:text-white">Our Products</h2>
        <!-- Filter and search by category dropdown -->
        <div class="mb-6">
            <form action="{{ url('products') }}" method="GET" class="flex items-center space-x-4">
                <select name="category" class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option value="All" style="color: #fff;">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" style="color: #fff;">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded transition-colors duration-300">
                    Filter
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <!-- Product Image Placeholder -- Extra Feature -->
                    <div class="bg-gray-200 h-48 flex items-center justify-center dark:bg-gray-700">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>

                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2 text-gray-900 dark:text-white">{{ $product->name }}</h3>

                        <!-- Categories -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach($product->categories as $category)
                                <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-xs rounded-full text-gray-800 dark:text-gray-200">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>

                        <!-- View Button -->
                        <a href="{{ route('products.show', $product->id) }}"
                           class="block w-full text-center bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded transition-colors duration-300">
                            View
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $products->links('vendor.pagination.tailwind') }}
        </div>
    </main>
</body>
</html>
