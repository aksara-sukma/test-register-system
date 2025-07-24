<!DOCTYPE html>
<html lang="id" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Sistem Pembayaran Aksara Karsa</title>
    
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
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center justify-center transition-colors duration-300 px-4">
    <div class="max-w-md w-full">
        <div class="card p-6 sm:p-8">
            <div class="text-center mb-8">
                <div class="h-12 w-12 bg-gradient-to-br from-primary-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <span class="text-white font-bold text-lg">AK</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">Admin Panel</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Aksara Karsa Payment System</p>
                
                <!-- Dark Mode Toggle -->
                <div class="mt-4">
                    <button onclick="toggleDarkMode()" 
                            class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-300 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                        </svg>
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-300 block dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-100 dark:bg-red-900/50 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.authenticate') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" 
                           class="input-field @error('email') border-red-500 @enderror" required>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                    <input id="password" type="password" name="password" 
                           class="input-field @error('password') border-red-500 @enderror" required>
                </div>

                <button type="submit" class="w-full btn-primary py-3">
                    Login
                </button>
            </form>

            <!-- HAPUS LINK KEMBALI KE BERANDA UNTUK LEBIH TERSEMBUNYI -->
        </div>
    </div>
</body>
</html>
