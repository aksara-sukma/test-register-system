<?php

namespace Database\Seeders;

use App\Models\Test;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    public function run()
    {
        $tests = [
            [
                'name' => 'Test Gelombang 1 - Januari 2024',
                'test_date' => '2024-01-15',
                'start_time' => '09:00:00',
                'end_time' => '12:00:00',
                'test_day' => 'Senin',
                'total_quota' => 50,
                'is_active' => true,
            ],
            [
                'name' => 'Test Gelombang 2 - Februari 2024',
                'test_date' => '2024-02-20',
                'start_time' => '13:00:00',
                'end_time' => '16:00:00',
                'test_day' => 'Selasa',
                'total_quota' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Test Gelombang 3 - Maret 2024',
                'test_date' => '2024-03-25',
                'start_time' => '08:00:00',
                'end_time' => '11:00:00',
                'test_day' => 'Rabu',
                'total_quota' => 40,
                'is_active' => true,
            ],
        ];

        foreach ($tests as $test) {
            Test::create($test);
        }
    }
}
