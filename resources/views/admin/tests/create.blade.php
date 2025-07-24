@extends('admin.layouts.app')

@section('title', 'Tambah Test Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="admin-header">Tambah Test Baru</h1>
        <p class="admin-subheader">Buat test baru untuk peserta</p>
    </div>

    <div class="card p-8">
        <form action="{{ route('admin.tests.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Test Name -->
            <div>
                <label for="name" class="form-label">
                    Nama Test <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                       class="input-field @error('name') border-red-500 @enderror"
                       placeholder="Contoh: Test Gelombang 1 - Januari 2024">
                @error('name')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Test Date -->
            <div>
                <label for="test_date" class="form-label">
                    Tanggal Test <span class="text-red-500">*</span>
                </label>
                <input type="date" name="test_date" id="test_date" value="{{ old('test_date') }}" 
                       class="input-field @error('test_date') border-red-500 @enderror"
                       min="{{ date('Y-m-d') }}">
                @error('test_date')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Test Day -->
            <div>
                <label for="test_day" class="form-label">
                    Hari Pelaksanaan <span class="text-red-500">*</span>
                </label>
                <select name="test_day" id="test_day" 
                        class="input-field @error('test_day') border-red-500 @enderror">
                    <option value="">Pilih Hari</option>
                    @php
                        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                    @endphp
                    @foreach($days as $day)
                        <option value="{{ $day }}" {{ old('test_day') == $day ? 'selected' : '' }}>
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
                <div>
                    <label for="start_time" class="form-label">
                        Jam Mulai <span class="text-red-500">*</span>
                    </label>
                    <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" 
                           class="input-field @error('start_time') border-red-500 @enderror">
                    @error('start_time')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="end_time" class="form-label">
                        Jam Selesai <span class="text-red-500">*</span>
                    </label>
                    <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}" 
                           class="input-field @error('end_time') border-red-500 @enderror">
                    @error('end_time')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Total Quota -->
            <div>
                <label for="total_quota" class="form-label">
                    Total Kuota <span class="text-red-500">*</span>
                </label>
                <input type="number" name="total_quota" id="total_quota" value="{{ old('total_quota') }}" 
                       class="input-field @error('total_quota') border-red-500 @enderror"
                       min="1" placeholder="Contoh: 50">
                @error('total_quota')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-4 pt-6">
                <a href="{{ route('admin.tests') }}" class="btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn-primary">
                    Simpan Test
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
