<?php

namespace Database\Seeders;

use App\Models\CancellationPolicy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CancellationPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CancellationPolicy::factory()->count(10)->create();
    }
}