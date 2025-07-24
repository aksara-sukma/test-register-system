<!DOCTYPE html>
<html lang="id" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Sistem Pembayaran Aksara Karsa</title>
    
    <!-- Anti-flash Dark Mode Script - HARUS DI ATAS CSS -->
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
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <div class="flex h-screen overflow-hidden">
        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0" 
             class="fixed inset-0 flex z-40 lg:hidden" 
             x-data="{ sidebarOpen: false }" 
             style="display: none;">
            <div class="fixed inset-0 bg-gray-600 bg-opacity-75" 
                 @click="sidebarOpen = false"></div>
        </div>

        <!-- Sidebar dengan enhanced colors -->
        <div class="hidden lg:flex lg:flex-shrink-0">
            <div class="flex flex-col w-64">
                <div class="flex flex-col flex-grow bg-white dark:bg-gray-900/95 pt-5 pb-4 overflow-y-auto border-r border-gray-200 dark:border-gray-700/60 backdrop-blur-sm">
                    <!-- Logo/Brand -->
                    <div class="flex items-center flex-shrink-0 px-4 mb-8">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center shadow-lg">
                                    <span class="text-white font-bold text-lg">AK</span>
                                </div>
                            </div>
                            <div class="ml-3">
                                <h1 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Admin Panel</h1>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Aksara Karsa</p>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Profile dengan warna yang lebih soft -->
                    <div class="px-4 mb-6">
                        <div class="flex items-center p-3 bg-gray-50 dark:bg-gray-800/60 rounded-lg border border-gray-100 dark:border-gray-700/50">
                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center shadow-md">
                                <span class="text-white font-medium text-sm">
                                    {{ substr(Auth::guard('admin')->user()->name, 0, 2) }}
                                </span>
                            </div>
                            <div class="ml-3 flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                    {{ Auth::guard('admin')->user()->name }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Administrator</p>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <nav class="flex-1 px-4 space-y-1">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6a2 2 0 01-2 2H10a2 2 0 01-2-2V5z"></path>
                            </svg>
                            <span class="sidebar-text">Dashboard</span>
                        </a>

                        <a href="{{ route('admin.tests') }}" 
                           class="sidebar-link {{ request()->routeIs('admin.tests*') ? 'active' : '' }}">
                            <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            <span class="sidebar-text">Kelola Test</span>
                            @if(\App\Models\Test::where('is_active', true)->count() > 0)
                                <span class="sidebar-badge">{{ \App\Models\Test::where('is_active', true)->count() }}</span>
                            @endif
                        </a>

                        <a href="{{ route('admin.bookings') }}" 
                           class="sidebar-link {{ request()->routeIs('admin.bookings*') ? 'active' : '' }}">
                            <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span class="sidebar-text">Kelola Booking</span>
                            @php $pendingCount = \App\Models\Booking::where('status', 'pending')->count(); @endphp
                            @if($pendingCount > 0)
                                <span class="sidebar-badge bg-red-500">{{ $pendingCount }}</span>
                            @endif
                        </a>

                        <!-- Settings -->
                        <div class="pt-4 mt-4 border-t border-gray-200 dark:border-gray-700">
                            <p class="px-3 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                                Settings
                            </p>
                        </div>

                        <button onclick="toggleDarkMode()" 
                                class="sidebar-link w-full text-left">
                            <svg class="sidebar-icon hidden dark:block" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <svg class="sidebar-icon block dark:hidden" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                            </svg>
                            <span class="sidebar-text">
                                <span class="hidden dark:inline">Mode Terang</span>
                                <span class="dark:hidden">Mode Gelap</span>
                            </span>
                        </button>
                    </nav>

                    <!-- Bottom Section -->
                    <div class="flex-shrink-0 px-4 py-4 border-t border-gray-200 dark:border-gray-700">
                        <form method="POST" action="{{ route('admin.logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="sidebar-link w-full text-left text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                                <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <span class="sidebar-text">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Header -->
        <div class="lg:hidden">
            <div class="flex items-center justify-between bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 py-3">
                <button @click="sidebarOpen = true" 
                        class="text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-lg font-semibold text-gray-900 dark:text-white">Admin Panel</h1>
                <button onclick="toggleDarkMode()" 
                        class="p-2 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                    <svg class="w-5 h-5 hidden dark:block" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <svg class="w-5 h-5 block dark:hidden" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        @if(session('success'))
                            <div class="mb-6 bg-green-100 dark:bg-green-900/50 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg flex items-center" role="alert">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="mb-6 bg-red-100 dark:bg-red-900/50 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg flex items-center" role="alert">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                {{ session('error') }}
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
