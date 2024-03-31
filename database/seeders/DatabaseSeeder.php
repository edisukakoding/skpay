<?php

namespace Database\Seeders;

use App\Models\Meter;
use App\Models\Rate;
use App\Models\User;
use App\Models\Customer;
use App\Models\RateDetail;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin'
        ]);

        $rate = Rate::create([
            'type' => 'Rumah Tangga A',
            'effective_date' => now(),
            'fixed_fee' => 22000,
            'status' => true
        ]);

        $rateDetails = [
            [
                'description' => 'Biaya Antara (0 - 10) m3',
                'threshold_limit' => 10,
                'price' => 2000,
                'rate_id' => $rate->id
            ],
            [
                'description' => 'Pemakaian lebih dari > 10 m3',
                'threshold_limit' => 20,
                'price' => 2500,
                'rate_id' => $rate->id
            ]
        ];

        foreach ($rateDetails as $detail) {
            RateDetail::create($detail);
        }

        $customer = Customer::create([
            'name' => 'Edi Hartono',
            'customer_type' => 'Perumahan',
            'nik' => '3321011309980001',
            'phone' => '089664684169',
            'email' => 'edi@gmail.com',
            'block' => 'C3-16',
            'address' => 'Karangsono RT 12 RW 01'
        ]);

        User::create([
            'email' => $customer->email,
            'name' => $customer->name,
            'role' => 'user',
            'password' => Hash::make('pda12345')
        ]);

        Meter::create([
            'customer_id' => $customer->id,
            'meter_number' => '123456789',
            'installation_date' => now(),
            'brand' => 'Amico',
            'meter_type' => 'Digital',
            'location' => 'Dapur',
            'rate_id' => $rate->id
        ]);
    }
}
