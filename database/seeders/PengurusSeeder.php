<?php

namespace Database\Seeders;

use App\Models\Pengurus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengurusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('penguruses')->truncate();

        $PengurusData = [
            [
                'nama' => 'Dr. Aulia Rahman, M.Kom',
                'jabatan' => 'Ketua Umum',
                'gambar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?fit=crop&w=500&h=500',
                'periode' => '2023 - 2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ir. Budi Santoso',
                'jabatan' => 'Wakil Ketua',
                'gambar' => 'https://images.unsplash.com/photo-1560250097-fb3ac9203195?fit=crop&w=500&h=500',
                'periode' => '2023 - 2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Siti Aminah, S.E.',
                'jabatan' => 'Sekretaris Jenderal',
                'gambar' => 'https://images.unsplash.com/photo-1544725176-7c40e5a71c5e?fit=crop&w=500&h=500',
                'periode' => '2023 - 2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ferry Gunawan, M.Ak',
                'jabatan' => 'Bendahara Umum',
                'gambar' => 'https://images.unsplash.com/photo-1599834562135-b6fc1c0d4520?fit=crop&w=500&h=500',
                'periode' => '2023 - 2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Dewi Lestari, S.H.',
                'jabatan' => 'Kepala Divisi Humas',
                'gambar' => 'https://images.unsplash.com/photo-1488426862944-ed83e9b9809c?fit=crop&w=500&h=500',
                'periode' => '2021 - 2023',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($PengurusData as $data) {
            Pengurus::create([
                'nama' => $data['nama'],
                'jabatan' => $data['jabatan'],
                'periode' => $data['periode'],
                'gambar' => $data['gambar'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
