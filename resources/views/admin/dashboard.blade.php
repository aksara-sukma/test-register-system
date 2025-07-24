@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="admin-header">Dashboard</h1>
        <p class="admin-subheader">Overview sistem booking test</p>
    </div>

    <!-- Stats Cards dengan warna yang diperbaiki -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="stats-card">
            <div class="flex items-center">
                <div class="stats-icon stats-blue">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Test</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalTests }}</p>
                </div>
            </div>
        </div>

        <div class="stats-card">
            <div class="flex items-center">
                <div class="stats-icon stats-green">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Test Aktif</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $activeTests }}</p>
                </div>
            </div>
        </div>

        <div class="stats-card">
            <div class="flex items-center">
                <div class="stats-icon stats-purple">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Booking</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalBookings }}</p>
                </div>
            </div>
        </div>

        <div class="stats-card">
            <div class="flex items-center">
                <div class="stats-icon stats-yellow">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pending Verifikasi</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $pendingBookings }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="card p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Aksi Cepat</h3>
            <div class="space-y-3">
                <a href="{{ route('admin.tests.create') }}" class="block btn-primary text-center">
                    Buat Test Baru
                </a>
                <a href="{{ route('admin.bookings') }}?status=pending" class="block btn-secondary text-center">
                    Lihat Booking Pending
                </a>
            </div>
        </div>

        <div class="card p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Ringkasan</h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Test Hari Ini:</span>
                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ \App\Models\Test::whereDate('test_date', today())->count() }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Booking Hari Ini:</span>
                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ \App\Models\Booking::whereDate('created_at', today())->count() }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Test Minggu Depan:</span>
                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ \App\Models\Test::whereBetween('test_date', [now()->startOfWeek()->addWeek(), now()->endOfWeek()->addWeek()])->count() }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
