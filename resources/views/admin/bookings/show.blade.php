@extends('admin.layouts.app')

@section('title', 'Detail Booking')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Detail Booking</h1>
            <p class="text-gray-600">Kode: {{ $booking->submit_code }}</p>
        </div>
        <a href="{{ route('admin.bookings') }}" class="btn-secondary">
            ← Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Booking Info -->
            <div class="card p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Booking</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Test</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $booking->test->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Tanggal Test</label>
                        <p class="mt-1 text-sm text-gray-900">
                            {{ $booking->test->test_day }}, {{ $booking->test->test_date->format('d M Y') }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Waktu</label>
                        <p class="mt-1 text-sm text-gray-900">
                            {{ date('H:i', strtotime($booking->test->start_time)) }} - 
                            {{ date('H:i', strtotime($booking->test->end_time)) }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Status</label>
                        <div class="mt-1">
                            @if($booking->status == 'pending')
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Menunggu Verifikasi
                                </span>
                            @elseif($booking->status == 'verified')
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Terverifikasi
                                </span>
                            @else
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    Ditolak
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Participant Info -->
            <div class="card p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Peserta</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Email</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $booking->email }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Nomor HP</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $booking->phone }}</p>
                    </div>
                    @if($booking->referral)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Referral</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $booking->referral }}</p>
                        </div>
                    @endif
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Tanggal Pendaftaran</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $booking->created_at->format('d M Y H:i') }}</p>
                    </div>
                    @if($booking->verified_at)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal Verifikasi</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $booking->verified_at->format('d M Y H:i') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Files -->
            <div class="card p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Dokumen Upload</h3>
                
                <!-- Payment Proof -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-500 mb-2">Bukti Pembayaran</label>
                    <div class="border rounded-lg p-4 bg-gray-50">
                        @php
                            $paymentProofUrl = Storage::url($booking->payment_proof);
                            $isImage = in_array(pathinfo($booking->payment_proof, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']);
                        @endphp
                        
                        @if($isImage)
                            <img src="{{ $paymentProofUrl }}" alt="Bukti Pembayaran" 
                                 class="max-w-full h-64 object-contain rounded">
                        @else
                            <div class="flex items-center">
                                <svg class="w-8 h-8 text-red-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ basename($booking->payment_proof) }}</span>
                            </div>
                        @endif
                        
                        <div class="mt-2">
                            <a href="{{ $paymentProofUrl }}" target="_blank" 
                               class="text-primary-600 hover:text-primary-700 text-sm">
                                Lihat File →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Additional Files -->
                @if($booking->additional_files && count($booking->additional_files) > 0)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Dokumen Tambahan</label>
                        <div class="space-y-3">
                            @foreach($booking->additional_files as $index => $file)
                                <div class="border rounded-lg p-4 bg-gray-50">
                                    @php
                                        $fileUrl = Storage::url($file);
                                        $isImage = in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']);
                                    @endphp
                                    
                                    @if($isImage)
                                        <img src="{{ $fileUrl }}" alt="Dokumen {{ $index + 1 }}" 
                                             class="max-w-full h-32 object-contain rounded mb-2">
                                    @else
                                        <div class="flex items-center mb-2">
                                            <svg class="w-6 h-6 text-red-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-sm">{{ basename($file) }}</span>
                                        </div>
                                    @endif
                                    
                                    <a href="{{ $fileUrl }}" target="_blank" 
                                       class="text-primary-600 hover:text-primary-700 text-sm">
                                        Lihat File {{ $index + 1 }} →
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div class="space-y-6">
            @if($booking->status == 'pending')
                <!-- Verification Actions -->
                <div class="card p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Aksi Verifikasi</h3>
                    <div class="space-y-3">
                        <form action="{{ route('admin.bookings.verify', $booking) }}" method="POST">
                            @csrf
                            <input type="hidden" name="action" value="verify">
                            <button type="submit" 
                                    class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200"
                                    onclick="return confirm('Yakin ingin memverifikasi booking ini?')">
                                ✓ Verifikasi
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.bookings.verify', $booking) }}" method="POST">
                            @csrf
                            <input type="hidden" name="action" value="reject">
                            <button type="submit" 
                                    class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200"
                                    onclick="return confirm('Yakin ingin menolak booking ini? Kuota akan dikembalikan.')">
                                ✗ Tolak
                            </button>
                        </form>
                    </div>
                </div>
            @endif

            <!-- Test Info -->
            <div class="card p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Info Test</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Kuota:</span>
                        <span class="font-medium">{{ $booking->test->total_quota }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Terverifikasi:</span>
                        <span class="font-medium text-green-600">{{ $booking->test->verified_quota }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Pending:</span>
                        <span class="font-medium text-yellow-600">{{ $booking->test->pending_quota }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tersisa:</span>
                        <span class="font-medium text-blue-600">{{ $booking->test->available_quota }}</span>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="card p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Kontak Peserta</h3>
                <div class="space-y-3">
                    <a href="mailto:{{ $booking->email }}" 
                       class="flex items-center text-sm text-blue-600 hover:text-blue-700">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                        Email
                    </a>
                    
                    <a href="https://wa.me/{{ str_replace('+', '', $booking->phone) }}" target="_blank"
                       class="flex items-center text-sm text-green-600 hover:text-green-700">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                        </svg>
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
