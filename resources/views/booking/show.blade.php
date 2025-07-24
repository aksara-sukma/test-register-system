@extends('layouts.app')

@section('title', 'Daftar ' . $test->name)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('booking.index') }}" 
               class="inline-flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Test
            </a>
        </div>

        <!-- Main Card -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
            
            <!-- Hero Header -->
            <div class="relative h-48 bg-gradient-to-r from-primary-500 via-purple-500 to-pink-500 overflow-hidden">
                <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white bg-opacity-10 rounded-full"></div>
                <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-white bg-opacity-5 rounded-full"></div>
                
                <!-- Status Badge -->
                <div class="absolute top-6 right-6">
                    @if($test->available_quota > 0)
                        @if($test->available_quota > 10)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300 shadow-lg">
                                <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                                Tersedia
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300 shadow-lg">
                                <div class="w-2 h-2 bg-yellow-400 rounded-full mr-2 animate-pulse"></div>
                                Terbatas
                            </span>
                        @endif
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300 shadow-lg">
                            <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                            Penuh
                        </span>
                    @endif
                </div>

                <!-- Test Info in Header -->
                <div class="relative h-full flex items-center justify-center text-center text-white p-8">
                    <div>
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-bold mb-3">{{ $test->name }}</h1>
                        <div class="inline-flex items-center px-4 py-2 bg-white bg-opacity-20 backdrop-blur-sm rounded-full text-sm font-medium">
                            {{ $test->test_day }}, {{ $test->test_date->format('d M Y') }} | 
                            {{ date('H:i', strtotime($test->start_time)) }} - {{ date('H:i', strtotime($test->end_time)) }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-8 -mt-8 relative">
                
                <!-- Enhanced Quota Info -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Informasi Kuota</h3>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $test->available_quota }}/{{ $test->total_quota }} tersisa
                        </span>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 mb-6 overflow-hidden">
                        <div class="h-3 rounded-full transition-all duration-700 ease-out {{ $test->available_quota > 10 ? 'bg-gradient-to-r from-green-400 to-green-500' : ($test->available_quota > 0 ? 'bg-gradient-to-r from-yellow-400 to-orange-500' : 'bg-gradient-to-r from-red-400 to-red-500') }}" 
                             style="width: {{ $test->total_quota > 0 ? (($test->total_quota - $test->available_quota) / $test->total_quota) * 100 : 0 }}%">
                        </div>
                    </div>

                    <!-- Quota Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-800">
                            <div class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-1">{{ $test->total_quota }}</div>
                            <div class="text-sm text-blue-700 dark:text-blue-300 font-medium">Total Kuota</div>
                        </div>
                        <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-xl border border-green-200 dark:border-green-800">
                            <div class="text-3xl font-bold text-green-600 dark:text-green-400 mb-1">{{ $test->verified_quota }}</div>
                            <div class="text-sm text-green-700 dark:text-green-300 font-medium">Sudah Verifikasi</div>
                        </div>
                        <div class="text-center p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-xl border border-yellow-200 dark:border-yellow-800">
                            <div class="text-3xl font-bold text-yellow-600 dark:text-yellow-400 mb-1">{{ $test->pending_quota }}</div>
                            <div class="text-sm text-yellow-700 dark:text-yellow-300 font-medium">Sedang Verifikasi</div>
                        </div>
                        <div class="text-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-xl border border-purple-200 dark:border-purple-800">
                            <div class="text-3xl font-bold text-purple-600 dark:text-purple-400 mb-1">{{ $test->available_quota }}</div>
                            <div class="text-sm text-purple-700 dark:text-purple-300 font-medium">Tersedia</div>
                        </div>
                    </div>
                </div>

                @if($test->available_quota > 0)
                    <!-- Enhanced Registration Form -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Form Pendaftaran</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Lengkapi data di bawah untuk mendaftar test</p>
                        </div>
                        
                        <form action="{{ route('booking.store', $test) }}" method="POST" enctype="multipart/form-data" 
                              x-data="{ additionalFiles: 0, isSubmitting: false }" class="p-6 space-y-6">
                            @csrf

                            <!-- Email -->
                            <div class="form-group">
                                <label class="form-label flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="email" name="email" value="{{ old('email') }}" 
                                           class="input-field pl-10 @error('email') border-red-500 @enderror"
                                           placeholder="contoh@gmail.com atau contoh@icloud.com">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Hanya email gmail.com dan icloud.com yang diterima</p>
                            </div>

                            <!-- Phone -->
                            <div class="form-group">
                                <label class="form-label flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    Nomor HP <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" name="phone" value="{{ old('phone') }}" 
                                           class="input-field pl-10 @error('phone') border-red-500 @enderror"
                                           placeholder="+6281234567890">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: +62 diikuti 8-13 digit angka</p>
                            </div>

                            <!-- Payment Proof -->
                            <div class="form-group">
                                <label class="form-label flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    Bukti Pembayaran <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl hover:border-primary-400 dark:hover:border-primary-500 transition-colors duration-200">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                            <label for="payment_proof" class="relative cursor-pointer bg-white dark:bg-gray-800 rounded-md font-medium text-primary-600 dark:text-primary-400 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                                                <span>Upload file</span>
                                                <input id="payment_proof" name="payment_proof" type="file" class="sr-only" accept=".jpg,.jpeg,.png,.pdf">
                                            </label>
                                            <p class="pl-1">atau drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, PDF hingga 5MB</p>
                                    </div>
                                </div>
                                @error('payment_proof')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Additional Files -->
                            <div class="form-group">
                                <label class="form-label flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Dokumen Tambahan (Opsional)
                                </label>
                                <div x-show="additionalFiles < 3" class="mb-3">
                                    <button type="button" @click="additionalFiles++" 
                                            class="inline-flex items-center px-4 py-2 border border-primary-300 dark:border-primary-600 rounded-lg text-sm font-medium text-primary-700 dark:text-primary-300 bg-primary-50 dark:bg-primary-900/30 hover:bg-primary-100 dark:hover:bg-primary-900/50 transition duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Tambah File
                                    </button>
                                </div>
                                
                                <template x-for="i in additionalFiles" :key="i">
                                    <div class="mb-3 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-gray-200 dark:border-gray-600">
                                        <div class="flex items-center space-x-3">
                                            <input type="file" :name="`additional_files[${i-1}]`" 
                                                   class="input-field flex-1" accept=".jpg,.jpeg,.png,.pdf">
                                            <button type="button" @click="additionalFiles--" 
                                                    class="inline-flex items-center p-2 border border-red-300 dark:border-red-600 rounded-lg text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 transition duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </template>
                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Maksimal 3 file tambahan. Format: JPG, PNG, PDF. Maksimal 5MB per file</p>
                            </div>

                            <!-- Referral -->
                            <div class="form-group">
                                <label class="form-label flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                    </svg>
                                    Kode Referral (Opsional)
                                </label>
                                <div class="relative">
                                    <input type="text" name="referral" value="{{ old('referral') }}" 
                                           class="input-field pl-10" placeholder="Masukkan kode referral jika ada">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Enhanced Submit Button -->
                            <div class="pt-6">
                                <button type="submit" 
                                        :disabled="isSubmitting"
                                        @click="isSubmitting = true"
                                        class="group relative w-full inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-primary-600 to-purple-600 hover:from-primary-700 hover:to-purple-700 rounded-xl shadow-lg hover:shadow-xl transform transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 disabled:cursor-not-allowed overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                                    <svg class="w-6 h-6 mr-3" :class="{'animate-spin': isSubmitting}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path x-show="!isSubmitting" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        <path x-show="isSubmitting" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    <span x-show="!isSubmitting">Daftar Test Sekarang</span>
                                    <span x-show="isSubmitting">Memproses...</span>
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <!-- Enhanced Full Quota State -->
                    <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700">
                        <div class="mx-auto w-24 h-24 bg-gradient-to-br from-red-100 to-red-200 dark:from-red-900/30 dark:to-red-800/30 rounded-full flex items-center justify-center mb-6 shadow-inner">
                            <svg class="w-12 h-12 text-red-500 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Kuota Sudah Penuh</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-md mx-auto">
                            Maaf, kuota untuk test ini sudah habis. Silakan pilih test lain yang masih tersedia.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('booking.index') }}" 
                               class="inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 9l6-6m0 0l6 6m-6-6v9a6 6 0 01-12 0v-3c0-2 1-3 2-4z"></path>
                                </svg>
                                Lihat Test Lain
                            </a>
                            <button onclick="window.location.reload()" 
                                    class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Refresh Halaman
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
