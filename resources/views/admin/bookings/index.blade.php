@extends('admin.layouts.app')

@section('title', 'Kelola Booking')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Kelola Booking</h1>
        <p class="text-gray-600">Verifikasi dan kelola semua booking peserta</p>
    </div>

    <!-- Filters -->
    <div class="card p-6">
        <form method="GET" action="{{ route('admin.bookings') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="test_id" class="block text-sm font-medium text-gray-700 mb-2">Filter Test</label>
                <select name="test_id" id="test_id" class="input-field">
                    <option value="">Semua Test</option>
                    @foreach($tests as $test)
                        <option value="{{ $test->id }}" {{ request('test_id') == $test->id ? 'selected' : '' }}>
                            {{ $test->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Filter Status</label>
                <select name="status" id="status" class="input-field">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Verified</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="btn-primary w-full">
                    Filter
                </button>
            </div>
        </form>
    </div>

        <!-- Bookings Table -->
        <div class="card">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="table-header">Kode Submit</th>
                            <th class="table-header">Test</th>
                            <th class="table-header">Peserta</th>
                            <th class="table-header">Status</th>
                            <th class="table-header">Tanggal Daftar</th>
                            <th class="table-header">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($bookings as $booking)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="table-cell">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->submit_code }}</div>
                                </td>
                                <td class="table-cell">
                                    <div class="text-sm text-gray-900 dark:text-white">{{ $booking->test->name }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $booking->test->test_date->format('d M Y') }}</div>
                                </td>
                                <td class="table-cell">
                                    <div class="text-sm text-gray-900 dark:text-white">{{ $booking->email }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $booking->phone }}</div>
                                </td>
                                <td class="table-cell">
                                    @if($booking->status == 'pending')
                                        <span class="status-pending">Pending</span>
                                    @elseif($booking->status == 'verified')
                                        <span class="status-verified">Verified</span>
                                    @else
                                        <span class="status-rejected">Rejected</span>
                                    @endif
                                </td>
                                <td class="table-cell">
                                    {{ $booking->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="table-cell text-right">
                                    <a href="{{ route('admin.bookings.show', $booking) }}" 
                                    class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="table-cell text-center text-gray-500 dark:text-gray-400">
                                    Tidak ada booking ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        @if($bookings->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
