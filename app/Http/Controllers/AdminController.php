<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Booking;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['login', 'authenticate']);
    }

    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $totalTests = Test::count();
        $activeTests = Test::where('is_active', true)->count();
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();

        return view('admin.dashboard', compact('totalTests', 'activeTests', 'totalBookings', 'pendingBookings'));
    }

    public function tests()
    {
        $tests = Test::orderBy('created_at', 'desc')->get();
        return view('admin.tests.index', compact('tests'));
    }

    public function createTest()
    {
        return view('admin.tests.create');
    }

    public function storeTest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'test_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'test_day' => 'required|string',
            'total_quota' => 'required|integer|min:1'
        ]);

        Test::create($request->all());

        return redirect()->route('admin.tests')->with('success', 'Test berhasil ditambahkan!');
    }

    public function editTest(Test $test)
    {
        return view('admin.tests.edit', compact('test'));
    }

    public function updateTest(Request $request, Test $test)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'test_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'test_day' => 'required|string',
            'total_quota' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ]);

        $test->update($request->all());

        return redirect()->route('admin.tests')->with('success', 'Test berhasil diupdate!');
    }

    public function bookings(Request $request)
    {
        $query = Booking::with('test')->orderBy('created_at', 'desc');

        if ($request->has('test_id') && $request->test_id != '') {
            $query->where('test_id', $request->test_id);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $bookings = $query->paginate(20);
        $tests = Test::all();

        return view('admin.bookings.index', compact('bookings', 'tests'));
    }

    public function showBooking(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function verifyBooking(Request $request, Booking $booking)
    {
        $action = $request->input('action');

        if ($action === 'verify') {
            $booking->update([
                'status' => 'verified',
                'verified_at' => now()
            ]);
            $message = 'Booking berhasil diverifikasi!';
        } elseif ($action === 'reject') {
            $booking->update(['status' => 'rejected']);
            $message = 'Booking ditolak!';
        }

        return redirect()->route('admin.bookings')->with('success', $message);
    }
}
