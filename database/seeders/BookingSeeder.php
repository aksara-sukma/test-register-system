<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Test;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $tests = Test::all();

        foreach ($tests as $test) {
            // Create some verified bookings
            for ($i = 1; $i <= 5; $i++) {
                Booking::create([
                    'test_id' => $test->id,
                    'email' => "user{$i}@gmail.com",
                    'phone' => "+6281234567{$i}0{$i}",
                    'payment_proof' => 'payment_proofs/dummy.jpg',
                    'status' => 'verified',
                    'verified_at' => now(),
                ]);
            }

            // Create some pending bookings
            for ($i = 6; $i <= 8; $i++) {
                Booking::create([
                    'test_id' => $test->id,
                    'email' => "user{$i}@gmail.com",
                    'phone' => "+6281234567{$i}0{$i}",
                    'payment_proof' => 'payment_proofs/dummy.jpg',
                    'status' => 'pending',
                ]);
            }
        }
    }
}
