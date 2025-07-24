<!DOCTYPE html>
<html lang="id" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan - Sistem Pembayaran Aksara Karsa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center justify-center transition-colors duration-300 px-4">
    <div class="max-w-md w-full text-center">
        <div class="card p-6 sm:p-8">
            <!-- Dark Mode Toggle -->
            <div class="absolute top-4 right-4">
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

            <!-- 404 Icon -->
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-red-100 dark:bg-red-900/50 mb-6">
                <svg class="h-10 w-10 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
            </div>

            <!-- 404 Message -->
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-4">404</h1>
            <h2 class="text-lg sm:text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">Halaman Tidak Ditemukan</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-8 text-sm sm:text-base">
                Maaf, halaman yang Anda cari tidak dapat ditemukan. 
                Mungkin halaman telah dipindahkan atau URL salah.
            </p>

            <!-- Actions -->
            <div class="space-y-3">
                <a href="{{ route('home') }}" class="w-full btn-primary block text-center">
                    Kembali ke Beranda
                </a>
                <a href="{{ route('booking.index') }}" class="w-full btn-secondary block text-center">
                    Lihat Daftar Test
                </a>
            </div>
        </div>
    </div>
</body>
</html>
