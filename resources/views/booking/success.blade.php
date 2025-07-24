@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-blue-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Main Success Card -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
            
            <!-- Celebration Header -->
            <div class="relative h-32 bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 overflow-hidden">
                <div class="absolute inset-0 bg-black bg-opacity-10"></div>
                <div class="absolute -top-8 -right-8 w-32 h-32 bg-white bg-opacity-10 rounded-full"></div>
                <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-white bg-opacity-5 rounded-full"></div>
                
                <!-- Floating elements -->
                <div class="absolute top-4 left-1/4 w-2 h-2 bg-white bg-opacity-60 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                <div class="absolute top-8 right-1/3 w-1.5 h-1.5 bg-white bg-opacity-40 rounded-full animate-bounce" style="animation-delay: 0.3s"></div>
                <div class="absolute bottom-6 left-1/3 w-1 h-1 bg-white bg-opacity-50 rounded-full animate-bounce" style="animation-delay: 0.5s"></div>
            </div>

            <!-- Content Area -->
            <div class="relative p-8 text-center -mt-8">
                
                <!-- Success Icon -->
                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-br from-green-400 to-green-600 mb-6 shadow-2xl ring-4 ring-green-50 dark:ring-green-900/30">
                    <svg class="h-10 w-10 text-white animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <!-- Success Message -->
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                    Selamat! 🎉
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400 mb-8 max-w-2xl mx-auto">
                    Data pendaftaran Anda telah berhasil dikirim dan sedang menunggu verifikasi dari tim kami.
                </p>

                <!-- Submit Code Card -->
                <div class="bg-gradient-to-br from-primary-50 to-blue-50 dark:from-primary-900/30 dark:to-blue-900/30 p-8 rounded-2xl mb-8 border border-primary-200 dark:border-primary-800 shadow-lg">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                        Kode Pendaftaran Anda
                    </h3>
                    <div class="inline-flex items-center justify-center bg-white dark:bg-gray-800 px-8 py-4 rounded-xl border-2 border-dashed border-primary-300 dark:border-primary-600 shadow-inner">
                        <span class="text-3xl font-bold text-primary-600 dark:text-primary-400 font-mono tracking-wider">
                            {{ $booking->submit_code }}
                        </span>
                        <button onclick="copyToClipboard('{{ $booking->submit_code }}')" 
                                class="ml-4 p-2 text-primary-600 dark:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/30 rounded-lg transition duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                        </button>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-3">
                        <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        Simpan kode ini untuk keperluan follow up
                    </p>
                </div>

                <!-- Process Timeline -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 mb-8 shadow-lg border border-gray-100 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6 flex items-center justify-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        Langkah Selanjutnya
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-start p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-xl border border-yellow-200 dark:border-yellow-800">
                            <div class="flex-shrink-0 w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center mr-4">
                                <span class="text-white font-bold text-sm">1</span>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-1">Verifikasi Admin</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Silahkan tunggu verifikasi 1×24 jam dari admin. Tim kami akan memeriksa dokumen yang Anda upload.
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-800">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center mr-4">
                                <span class="text-white font-bold text-sm">2</span>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-1">Notifikasi Email</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Informasi pendaftaran akan dikirim melalui email: 
                                    <span class="font-medium text-blue-600 dark:text-blue-400">{{ $booking->email }}</span>
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start p-4 bg-green-50 dark:bg-green-900/20 rounded-xl border border-green-200 dark:border-green-800">
                            <div class="flex-shrink-0 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-4">
                                <span class="text-white font-bold text-sm">3</span>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-1">Konfirmasi WhatsApp</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Atau melalui WhatsApp: 
                                    <span class="font-medium text-green-600 dark:text-green-400">{{ $booking->phone }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Support -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-2xl p-6 mb-8 border border-blue-200 dark:border-blue-800">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Butuh Bantuan?</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Hubungi admin untuk follow up dan konfirmasi</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="https://wa.me/62xxxxxxxxxxx" target="_blank" 
                           class="inline-flex items-center justify-center px-6 py-3 bg-green-500 hover:bg-green-600 text-white rounded-xl font-medium transition duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                            </svg>
                            WhatsApp Admin
                        </a>
                        <a href="mailto:admin@aksarakarsa.com" 
                           class="inline-flex items-center justify-center px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-xl font-medium transition duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Email Admin
                        </a>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('home') }}" 
                       class="inline-flex items-center justify-center px-8 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-medium transition duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Kembali ke Beranda
                    </a>
                    <a href="{{ route('booking.index') }}" 
                       class="inline-flex items-center justify-center px-8 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-xl font-medium transition duration-200 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        Lihat Test Lain
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success feedback
        const button = event.target.closest('button');
        const originalHTML = button.innerHTML;
        button.innerHTML = `
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        `;
        setTimeout(() => {
            button.innerHTML = originalHTML;
        }, 2000);
    }).catch(function(err) {
        console.error('Failed to copy: ', err);
    });
}
</script>
@endsection
