@extends('admin.layouts.app')

@section('title', 'Kelola Test')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="admin-header">Kelola Test</h1>
            <p class="admin-subheader">Manage semua test yang tersedia</p>
        </div>
        <a href="{{ route('admin.tests.create') }}" class="btn-primary">
            <svg class="w-5 h-5 mr-2 inline" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
            </svg>
            Tambah Test Baru
        </a>
    </div>

    <!-- Tests Table -->
    <div class="card">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800/80">
                    <tr>
                        <th class="table-header">Nama Test</th>
                        <th class="table-header">Tanggal & Waktu</th>
                        <th class="table-header">Kuota</th>
                        <th class="table-header">Status</th>
                        <th class="table-header">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800/30 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($tests as $test)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="table-cell">
                                <div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $test->name }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $test->test_day }}</div>
                                </div>
                            </td>
                            <td class="table-cell">
                                <div class="text-sm text-gray-900 dark:text-gray-100">{{ $test->test_date->format('d M Y') }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ date('H:i', strtotime($test->start_time)) }} - {{ date('H:i', strtotime($test->end_time)) }}
                                </div>
                            </td>
                            <td class="table-cell">
                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <span class="quota-badge quota-total">
                                            Total: {{ $test->total_quota }}
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <span class="quota-badge quota-verified">
                                            Verified: {{ $test->verified_quota }}
                                        </span>
                                        <span class="quota-badge quota-pending">
                                            Pending: {{ $test->pending_quota }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="table-cell">
                                @if($test->is_active)
                                    <span class="status-active">
                                        <span class="status-dot bg-green-400"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="status-inactive">
                                        <span class="status-dot bg-red-400"></span>
                                        Tidak Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="table-cell text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.tests.edit', $test) }}" 
                                       class="action-btn action-edit">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.bookings') }}?test_id={{ $test->id }}" 
                                       class="action-btn action-view" title="Lihat Booking">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="table-cell text-center text-gray-500 dark:text-gray-400 py-8">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-lg font-medium">Belum ada test yang dibuat</p>
                                    <p class="text-sm">Klik "Tambah Test Baru" untuk membuat test pertama.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
