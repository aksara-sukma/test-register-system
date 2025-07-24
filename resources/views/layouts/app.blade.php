<!DOCTYPE html>
<html lang="id" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aksara Karsa Payment System')</title>
    
    <!-- Anti-flash Dark Mode Script -->
    <script>
        (function() {
            const darkMode = localStorage.getItem('darkMode');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            
            if (darkMode === 'true' || (darkMode === null && prefersDark)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300">
    <!-- Navigation -->
    <nav class="bg-white/90 dark:bg-gray-900/90 backdrop-blur-md shadow-sm border-b border-gray-200 dark:border-gray-700/60 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex items-center">
                        <div class="h-8 w-8 bg-gradient-to-br from-primary-500 to-purple-600 rounded-lg flex items-center justify-center mr-3 shadow-lg">
                            <span class="text-white font-bold text-sm">AK</span>
                        </div>
                        <a href="{{ route('home') }}" class="text-xl font-bold text-gray-900 dark:text-gray-100">
                            <span class="block sm:hidden">Aksara Karsa</span>
                            <span class="hidden sm:block">Aksara Karsa Payment System</span>
                        </a>
                    </div>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('booking.index') }}" 
                       class="text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition duration-200 px-3 py-2 rounded-md font-medium">
                        Payment Portal
                    </a>
                    
                    <!-- Dark Mode Toggle - HANYA DI DESKTOP -->
                    <button onclick="toggleDarkMode()" 
                            class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700/80 hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-200 border border-transparent dark:border-gray-600/50">
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-300 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                        </svg>
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-300 block dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                    </button>
                </div>

                <!-- Mobile Header - DIPERBAIKI -->
                <div class="md:hidden flex items-center space-x-4">
                    <!-- Static Payment Portal Text di Mobile -->
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300 px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded-md">
                        Payment Portal
                    </span>                    
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu - DIHAPUS ATAU DISEDERHANAKAN -->
        <div id="mobileMenu" class="md:hidden hidden bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
            <div class="px-4 py-2 space-y-1">
                <!-- Bisa dikosongkan atau dihapus jika tidak diperlukan -->
                <div class="text-center py-4 text-sm text-gray-500 dark:text-gray-400">
                    Menu navigasi tambahan bisa ditambahkan di sini jika diperlukan
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                <div class="bg-green-100 dark:bg-green-900/50 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg flex items-center" role="alert">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                <div class="bg-red-100 dark:bg-red-900/50 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg flex items-center" role="alert">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-auto">
        <div class="py-3">
            <div class="text-center text-sm text-gray-600 dark:text-gray-400">
                <p>&copy; {{ date('Y') }} Aksara Karsa Payment System. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
