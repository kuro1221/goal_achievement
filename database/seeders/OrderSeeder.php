<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            $totalAmount = rand(1000, 10000);
            $totalQty = rand(10, 50);
            $createdAt = now()->subDays($i);
            DB::table('orders')->insert([
                'total_amount' => $totalAmount,
                'total_qty' => $totalQty,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }
    }
}
