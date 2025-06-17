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
                        <a href="{{ url('/') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                            Back
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
        <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Product Details</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

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
                         <!-- Product Variants -->
                       <div class="mb-4">
        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Available Variants:</h4>
        <div class="space-y-2">
            @foreach($product->variants as $variant)
                <div class="flex flex-col sm:flex-row sm:items-center gap-2 p-2 bg-gray-50 dark:bg-gray-700 rounded-lg text-white">
                    <span class="px-2 py-1 bg-white dark:bg-gray-600 text-xs rounded-full font-medium">
                        {{ $variant->name }}
                        <!-- Loop through product variants to set 'delete' button on each -->
                        <form action="{{ route('variant.destroy', $variant->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900"
                                    onclick="return confirm('Are you sure you want to delete this variant?')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </span>
                    <span class="px-2 py-1 bg-white dark:bg-gray-600 text-xs rounded-full">
                        R{{ number_format($variant->price, 2) }}
                    </span>
                    <span class="px-2 py-1 bg-white dark:bg-gray-600 text-xs rounded-full">
                        Stock: {{ $variant->stock }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>

                        <!-- Delete Button -->
                        <a href="{{ route('products.destroy', $product->id) }}"
                           class="block w-full text-center bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded transition-colors duration-300">
                            Delete
                        </a>
                        <br>
                         <a href="{{ route('products.edit', $product->id) }}"
                           class="block w-full text-center bg-yellow-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded transition-colors duration-300">
                            Edit
                        </a>
                    </div>
                </div>

        </div>
    </main>
</body>
</html>
