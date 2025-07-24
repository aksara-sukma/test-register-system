<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function index()
    {
        $tests = Test::where('is_active', true)
                    ->where('test_date', '>=', now()->toDateString())
                    ->get();
        
        return view('booking.index', compact('tests'));
    }

    public function show(Test $test)
    {
        if (!$test->is_active || $test->test_date < now()->toDateString()) {
            abort(404);
        }

        return view('booking.show', compact('test'));
    }

    public function store(Request $request, Test $test)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@(gmail\.com|icloud\.com)$/'],
            'phone' => ['required', 'regex:/^\+62[0-9]{8,13}$/', 'min:12', 'max:15'],
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'additional_files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'referral' => 'nullable|string|max:255'
        ], [
            'email.regex' => 'Email harus menggunakan domain gmail.com atau icloud.com',
            'phone.regex' => 'Nomor HP harus dimulai dengan +62 dan berisi 10-13 digit',
            'payment_proof.required' => 'Bukti pembayaran wajib diupload',
            'payment_proof.max' => 'Ukuran file maksimal 5MB',
            'additional_files.*.max' => 'Ukuran file maksimal 5MB'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Check quota
        if ($test->available_quota <= 0) {
            return back()->with('error', 'Maaf, kuota test sudah penuh!');
        }

        // Check duplicate email
        if (Booking::where('test_id', $test->id)->where('email', $request->email)->exists()) {
            return back()->with('error', 'Email sudah terdaftar untuk test ini!');
        }

        // Store payment proof
        $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Store additional files
        $additionalFiles = [];
        if ($request->hasFile('additional_files')) {
            foreach ($request->file('additional_files') as $file) {
                if ($file && count($additionalFiles) < 3) {
                    $additionalFiles[] = $file->store('additional_files', 'public');
                }
            }
        }

        $booking = Booking::create([
            'test_id' => $test->id,
            'email' => $request->email,
            'phone' => $request->phone,
            'payment_proof' => $paymentProofPath,
            'additional_files' => $additionalFiles,
            'referral' => $request->referral
        ]);

        return redirect()->route('booking.success', $booking->submit_code);
    }

    public function success($submitCode)
    {
        $booking = Booking::where('submit_code', $submitCode)->first();
        
        if (!$booking) {
            abort(404);
        }

        return view('booking.success', compact('booking'));
    }
}