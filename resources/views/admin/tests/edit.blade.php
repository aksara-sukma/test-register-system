@extends('admin.layouts.app')

@section('title', 'Edit Test')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="admin-header">Edit Test</h1>
        <p class="admin-subheader">Edit informasi test: {{ $test->name }}</p>
    </div>

    <div class="card p-8">
        <form action="{{ route('admin.tests.update', $test) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Test Name -->
            <div class="form-group">
                <label for="name" class="form-label">
                    Nama Test <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $test->name) }}" 
                       class="input-field @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Test Date -->
            <div class="form-group">
                <label for="test_date" class="form-label">
                    Tanggal Test <span class="text-red-500">*</span>
                </label>
                <input type="date" name="test_date" id="test_date" 
                       value="{{ old('test_date', $test->test_date->format('Y-m-d')) }}" 
                       class="input-field @error('test_date') border-red-500 @enderror">
                @error('test_date')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Test Day -->
            <div class="form-group">
                <label for="test_day" class="form-label">
                    Hari Pelaksanaan <span class="text-red-500">*</span>
                </label>
                <select name="test_day" id="test_day" 
                        class="input-field @error('test_day') border-red-500 @enderror">
                    @php
                        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                    @endphp
                    @foreach($days as $day)
                        <option value="{{ $day }}" 
                                {{ old('test_day', $test->test_day) == $day ? 'selected' : '' }}>
                            {{ $day }}
                        </option>
                    @endforeach
                </select>
                @error('test_day')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Time Range -->
            <div class="grid grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="start_time" class="form-label">
                        Jam Mulai <span class="text-red-500">*</span>
                    </label>
                    <input type="time" name="start_time" id="start_time" 
                           value="{{ old('start_time', date('H:i', strtotime($test->start_time))) }}" 
                           class="input-field @error('start_time') border-red-500 @enderror">
                    @error('start_time')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="end_time" class="form-label">
                        Jam Selesai <span class="text-red-500">*</span>
                    </label>
                    <input type="time" name="end_time" id="end_time" 
                           value="{{ old('end_time', date('H:i', strtotime($test->end_time))) }}" 
                           class="input-field @error('end_time') border-red-500 @enderror">
                    @error('end_time')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Total Quota -->
            <div class="form-group">
                <label for="total_quota" class="form-label">
                    Total Kuota <span class="text-red-500">*</span>
                </label>
                <input type="number" name="total_quota" id="total_quota" 
                       value="{{ old('total_quota', $test->total_quota) }}" 
                       class="input-field @error('total_quota') border-red-500 @enderror"
                       min="1">
                @error('total_quota')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Current usage: {{ $test->verified_quota + $test->pending_quota }} dari {{ $test->total_quota }}
                </p>
            </div>

            <!-- Status - DIPERBAIKI DENGAN CUSTOM CHECKBOX -->
            <div class="form-group">
                <div class="form-checkbox-group">
                    <label class="custom-checkbox">
                        <input type="checkbox" name="is_active" value="1" 
                               {{ old('is_active', $test->is_active) ? 'checked' : '' }}>
                        <div class="custom-checkbox-box">
                            <svg class="custom-checkbox-check w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </label>
                    <div class="form-checkbox-content">
                        <div class="form-checkbox-label">Test Aktif</div>
                        <div class="form-checkbox-description">
                            Uncheck untuk menonaktifkan test (peserta tidak bisa mendaftar)
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current Bookings Info -->
            @if($test->bookings->count() > 0)
                <div class="bg-blue-50 dark:bg-blue-900/30 p-4 rounded-lg border border-blue-200 dark:border-blue-700/50">
                    <h4 class="font-medium text-blue-900 dark:text-blue-300 mb-2">Informasi Booking Saat Ini:</h4>
                    <div class="text-sm text-blue-800 dark:text-blue-200 space-y-1">
                        <p>Total Booking: {{ $test->bookings->count() }}</p>
                        <p>Sudah Verifikasi: {{ $test->verified_quota }}</p>
                        <p>Sedang Verifikasi: {{ $test->pending_quota }}</p>
                        <p>Kuota Tersisa: {{ $test->available_quota }}</p>
                    </div>
                </div>
            @endif

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-4 pt-6">
                <a href="{{ route('admin.tests') }}" class="btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn-primary">
                    Update Test
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
