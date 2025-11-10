<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            KegiatanSeeder::class,
            CeritaSeeder::class,
            DonasiSeeder::class,
        ]);
    }
}
