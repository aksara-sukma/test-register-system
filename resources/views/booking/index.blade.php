@extends('layouts.app')

@section('title', 'Daftar Test Tersedia')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ 
        showFilters: false, 
        searchTerm: '', 
        selectedDate: '', 
        sortBy: 'date_asc',
        viewMode: 'grid',
        showMobileControls: false
    }">
        
        <!-- Mobile Header Controls -->
        <div class="lg:hidden flex items-center justify-between mb-6 bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-100 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Test Tersedia</h2>
            <div class="flex items-center space-x-2">
                <!-- Dark Mode Toggle Mobile -->
                <button onclick="toggleDarkMode()" 
                        class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-300 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                    </svg>
                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-300 block dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                </button>
                
                <!-- View Toggle Mobile -->
                <div class="flex items-center space-x-1 bg-gray-100 dark:bg-gray-700 rounded-lg p-1">
                    <button @click="viewMode = 'grid'" 
                            :class="viewMode === 'grid' ? 'bg-white dark:bg-gray-600 text-primary-600 dark:text-primary-400 shadow-sm' : 'text-gray-500 dark:text-gray-400'"
                            class="p-2 rounded-md transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                    </button>
                    <button @click="viewMode = 'list'"
                            :class="viewMode === 'list' ? 'bg-white dark:bg-gray-600 text-primary-600 dark:text-primary-400 shadow-sm' : 'text-gray-500 dark:text-gray-400'"
                            class="p-2 rounded-md transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Enhanced Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-primary-500 to-purple-600 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                Test <span class="text-gradient bg-gradient-to-r from-primary-600 to-purple-600 bg-clip-text text-transparent">Tersedia</span>
            </h1>
            <p class="text-lg sm:text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Pilih jadwal test yang sesuai dengan kebutuhan Anda
            </p>
        </div>

        <!-- Modern Filter & Search Bar -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 mb-8 border border-gray-100 dark:border-gray-700">
            
            <!-- Quick Search -->
            <div class="flex flex-col lg:flex-row gap-4 mb-6">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" 
                           placeholder="Cari nama test, lokasi, atau kata kunci..." 
                           class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-xl leading-5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition duration-200"
                           x-model="searchTerm">
                </div>
                
                <!-- Filter Toggle Button -->
                <button @click="showFilters = !showFilters" 
                        class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 transition duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                    </svg>
                    Filter & Sort
                    <svg class="w-4 h-4 ml-2 transition-transform duration-200" :class="{'rotate-180': showFilters}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>

            <!-- Advanced Filters -->
            <div x-show="showFilters" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                
                <!-- Date Filter with Calendar -->
                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                        Filter Tanggal
                    </label>
                    <div class="relative">
                        <input type="date" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition duration-200"
                               x-model="selectedDate">
                    </div>
                </div>

                <!-- Sort Options -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                        </svg>
                        Urutkan
                    </label>
                    <select class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition duration-200"
                            x-model="sortBy">
                        <option value="date_asc">Tanggal (Terlama)</option>
                        <option value="date_desc">Tanggal (Terbaru)</option>
                        <option value="name_asc">Nama (A-Z)</option>
                        <option value="name_desc">Nama (Z-A)</option>
                        <option value="quota_desc">Kuota Tersedia (Terbanyak)</option>
                        <option value="quota_asc">Kuota Tersedia (Tersedikit)</option>
                    </select>
                </div>

                <!-- Quick Filters -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Filter Cepat
                    </label>
                    <div class="flex flex-wrap gap-2">
                        <button data-filter="today" 
                                class="filter-today px-3 py-1 text-xs font-medium bg-primary-100 text-primary-800 dark:bg-primary-900/30 dark:text-primary-300 rounded-full hover:bg-primary-200 dark:hover:bg-primary-900/50 transition duration-200">
                            Hari Ini
                        </button>
                        <button data-filter="week"
                                class="filter-week px-3 py-1 text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300 rounded-full hover:bg-green-200 dark:hover:bg-green-900/50 transition duration-200">
                            Minggu Ini
                        </button>
                        <button data-filter="available"
                                class="filter-available px-3 py-1 text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 rounded-full hover:bg-blue-200 dark:hover:bg-blue-900/50 transition duration-200">
                            Kuota Tersedia
                        </button>
                    </div>
                </div>
            </div>

            <!-- Active Filters Display -->
            <div class="flex flex-wrap gap-2 mt-4">
                <template x-if="searchTerm">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-primary-100 text-primary-800 dark:bg-primary-900/30 dark:text-primary-300">
                        Pencarian: <span class="font-medium ml-1" x-text="searchTerm"></span>
                        <button @click="searchTerm = ''" class="ml-2 hover:text-primary-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </span>
                </template>
                <template x-if="selectedDate">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                        Tanggal: <span class="font-medium ml-1" x-text="selectedDate"></span>
                        <button @click="selectedDate = ''" class="ml-2 hover:text-green-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </span>
                </template>
            </div>
        </div>

        <!-- Results Summary -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="mb-2 sm:mb-0">
                <p class="text-lg font-semibold text-gray-900 dark:text-white" data-results-count>
                    {{ $tests->count() }} Test Ditemukan
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ $tests->where('available_quota', '>', 0)->count() }} test masih tersedia
                </p>
            </div>
            
            <!-- View Toggle Desktop -->
            <div class="hidden lg:flex items-center space-x-2 bg-gray-100 dark:bg-gray-700 rounded-lg p-1">
                <button @click="viewMode = 'grid'" 
                        :class="viewMode === 'grid' ? 'bg-white dark:bg-gray-600 text-primary-600 dark:text-primary-400 shadow-sm' : 'text-gray-500 dark:text-gray-400'"
                        class="p-2 rounded-md transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                </button>
                <button @click="viewMode = 'list'"
                        :class="viewMode === 'list' ? 'bg-white dark:bg-gray-600 text-primary-600 dark:text-primary-400 shadow-sm' : 'text-gray-500 dark:text-gray-400'"
                        class="p-2 rounded-md transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Enhanced Tests Display -->
        @if($tests->count() > 0)
            <!-- Grid View -->
            <div x-show="viewMode === 'grid'" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 class="grid gap-6 grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
                @foreach($tests as $test)
                    <div class="group relative bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-500 hover:-translate-y-2 hover:scale-[1.02]" 
                         data-test-card 
                         data-available-quota="{{ $test->available_quota }}"
                         data-test-date="{{ $test->test_date->format('Y-m-d') }}">
                        
                        <!-- Status Badge -->
                        <div class="absolute top-4 right-4 z-10">
                            @if($test->available_quota > 0)
                                @if($test->available_quota > 10)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                        <div class="w-2 h-2 bg-green-400 rounded-full mr-1.5 animate-pulse"></div>
                                        Tersedia
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">
                                        <div class="w-2 h-2 bg-yellow-400 rounded-full mr-1.5 animate-pulse"></div>
                                        Terbatas
                                    </span>
                                @endif
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                    <div class="w-2 h-2 bg-red-400 rounded-full mr-1.5"></div>
                                    Penuh
                                </span>
                            @endif
                        </div>

                        <!-- Gradient Header -->
                        <div class="h-24 bg-gradient-to-r from-primary-500 via-purple-500 to-pink-500 relative overflow-hidden">
                            <div class="absolute inset-0 bg-black bg-opacity-10"></div>
                            <div class="absolute -top-4 -right-4 w-24 h-24 bg-white bg-opacity-10 rounded-full"></div>
                            <div class="absolute -bottom-2 -left-2 w-16 h-16 bg-white bg-opacity-5 rounded-full"></div>
                        </div>

                        <!-- Content -->
                        <div class="p-6 -mt-4 relative">
                            <!-- Test Name -->
                            <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-100 dark:border-gray-700 mb-4">
                                <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition duration-300">
                                    {{ $test->name }}
                                </h3>
                                
                                <!-- Date & Time -->
                                <div class="space-y-2">
                                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                        <div class="w-8 h-8 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                            <svg class="w-4 h-4 text-primary-600 dark:text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">{{ $test->test_day }}</p>
                                            <p class="text-xs">{{ $test->test_date->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                        <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                            <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">
                                                {{ date('H:i', strtotime($test->start_time)) }} - {{ date('H:i', strtotime($test->end_time)) }}
                                            </p>
                                            <p class="text-xs">
                                                {{ \Carbon\Carbon::parse($test->start_time)->diffInHours(\Carbon\Carbon::parse($test->end_time)) }} jam
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quota Info with Progress Bar -->
                            <div class="mb-6">
                                <div class="flex items-center justify-between mb-3">
                                    <h4 class="font-semibold text-gray-900 dark:text-white text-sm">Informasi Kuota</h4>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $test->available_quota }}/{{ $test->total_quota }} tersisa
                                    </span>
                                </div>
                                
                                <!-- Progress Bar -->
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5 mb-3 overflow-hidden">
                                    <div class="h-2.5 rounded-full transition-all duration-700 ease-out {{ $test->available_quota > 10 ? 'bg-gradient-to-r from-green-400 to-green-500' : ($test->available_quota > 0 ? 'bg-gradient-to-r from-yellow-400 to-orange-500' : 'bg-gradient-to-r from-red-400 to-red-500') }}" 
                                         style="width: {{ $test->total_quota > 0 ? (($test->total_quota - $test->available_quota) / $test->total_quota) * 100 : 0 }}%">
                                    </div>
                                </div>

                                <!-- Quota Details -->
                                <div class="grid grid-cols-3 gap-2 text-xs">
                                    <div class="text-center p-2 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                                        <div class="font-bold text-green-700 dark:text-green-400">{{ $test->verified_quota }}</div>
                                        <div class="text-green-600 dark:text-green-500">Verified</div>
                                    </div>
                                    <div class="text-center p-2 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-200 dark:border-yellow-800">
                                        <div class="font-bold text-yellow-700 dark:text-yellow-400">{{ $test->pending_quota }}</div>
                                        <div class="text-yellow-600 dark:text-yellow-500">Pending</div>
                                    </div>
                                    <div class="text-center p-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                                        <div class="font-bold text-blue-700 dark:text-blue-400">{{ $test->available_quota }}</div>
                                        <div class="text-blue-600 dark:text-blue-500">Tersedia</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Button -->
                            @if($test->available_quota > 0)
                                <a href="{{ route('booking.show', $test) }}" 
                                   class="group/btn relative w-full inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-primary-600 to-purple-600 hover:from-primary-700 hover:to-purple-700 rounded-xl shadow-lg hover:shadow-xl transform transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 transform -skew-x-12 -translate-x-full group-hover/btn:translate-x-full transition-transform duration-700"></div>
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Daftar Sekarang
                                </a>
                            @else
                                <button disabled class="w-full inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-gray-500 dark:text-gray-400 bg-gray-200 dark:bg-gray-700 rounded-xl cursor-not-allowed">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                                    </svg>
                                    Kuota Penuh
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- List View -->
            <div x-show="viewMode === 'list'" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 class="space-y-4">
                @foreach($tests as $test)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:scale-[1.01]"
                         data-test-card 
                         data-available-quota="{{ $test->available_quota }}"
                         data-test-date="{{ $test->test_date->format('Y-m-d') }}">
                        <div class="p-6">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                                <!-- Left Content -->
                                <div class="flex-1 lg:pr-6">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex-1">
                                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $test->name }}</h3>
                                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2 text-primary-600 dark:text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span>{{ $test->test_day }}, {{ $test->test_date->format('d M Y') }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span>{{ date('H:i', strtotime($test->start_time)) }} - {{ date('H:i', strtotime($test->end_time)) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Status Badge -->
                                        <div class="ml-4">
                                            @if($test->available_quota > 0)
                                                @if($test->available_quota > 10)
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                                        <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                                                        Tersedia
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">
                                                        <div class="w-2 h-2 bg-yellow-400 rounded-full mr-2 animate-pulse"></div>
                                                        Terbatas
                                                    </span>
                                                @endif
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                                    <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                                    Penuh
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Quota Progress -->
                                    <div class="mb-4">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-sm font-medium text-gray-900 dark:text-white">Kuota: {{ $test->available_quota }}/{{ $test->total_quota }} tersisa</span>
                                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $test->total_quota > 0 ? round(($test->available_quota / $test->total_quota) * 100) : 0 }}%
                                            </span>
                                        </div>
                                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                            <div class="h-2 rounded-full transition-all duration-500 {{ $test->available_quota > 10 ? 'bg-gradient-to-r from-green-400 to-green-500' : ($test->available_quota > 0 ? 'bg-gradient-to-r from-yellow-400 to-orange-500' : 'bg-gradient-to-r from-red-400 to-red-500') }}" 
                                                 style="width: {{ $test->total_quota > 0 ? (($test->total_quota - $test->available_quota) / $test->total_quota) * 100 : 0 }}%">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Action -->
                                <div class="lg:ml-6 mt-4 lg:mt-0">
                                    @if($test->available_quota > 0)
                                        <a href="{{ route('booking.show', $test) }}" 
                                           class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-primary-600 to-purple-600 hover:from-primary-700 hover:to-purple-700 rounded-xl shadow-lg hover:shadow-xl transform transition-all duration-300 hover:scale-105">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            Daftar Sekarang
                                        </a>
                                    @else
                                        <button disabled class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-gray-500 dark:text-gray-400 bg-gray-200 dark:bg-gray-700 rounded-xl cursor-not-allowed">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                                            </svg>
                                            Kuota Penuh
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Enhanced Empty State -->
            <div class="text-center py-16">
                <div class="relative">
                    <div class="mx-auto w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 rounded-full flex items-center justify-center mb-6 shadow-inner">
                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Belum Ada Test Tersedia</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6 max-w-md mx-auto">
                        Saat ini belum ada jadwal test yang dapat diikuti. Periksa kembali nanti atau hubungi admin untuk informasi lebih lanjut.
                    </p>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                        <button onclick="window.location.reload()" 
                                class="inline-flex items-center px-6 py-3 border border-primary-300 text-primary-700 dark:text-primary-400 bg-white dark:bg-gray-800 rounded-xl hover:bg-primary-50 dark:hover:bg-gray-700 transition duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Refresh Halaman
                        </button>
                        <a href="mailto:admin@aksarakarsa.com" 
                           class="inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Hubungi Admin
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Loading Overlay -->
<div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-2xl max-w-sm mx-4">
        <div class="flex items-center space-x-4">
            <div class="w-8 h-8 border-4 border-primary-600 border-t-transparent rounded-full animate-spin"></div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Memuat...</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Sedang memproses permintaan Anda</p>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fade-in-up 0.6s ease-out forwards;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Custom scrollbar for mobile */
@media (max-width: 768px) {
    ::-webkit-scrollbar {
        width: 4px;
    }
    
    ::-webkit-scrollbar-track {
        background: transparent;
    }
    
    ::-webkit-scrollbar-thumb {
        background: rgba(156, 163, 175, 0.5);
        border-radius: 2px;
    }
}
</style>
@endsection
