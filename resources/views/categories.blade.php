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
        <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Manage Categories</h2>
        <br>
           <a href="{{ route('addCategory') }}" 
                           class="text-center bg-blue-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded transition-colors duration-300">
                            Add Category
            </a>
        
        <!-- Display of category table with delete buttons for each category -->
        <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($categories as $category)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $category->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" 
                                    onclick="return confirm('Are you sure you want to delete this category?')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                        <td>
                            <a href="{{ route('editCategory', $category->id) }}" 
                                class="text-center bg-yellow-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded transition-colors duration-300">
                            Edit
            </a>
                        <td>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    </main>
</body>
</html>