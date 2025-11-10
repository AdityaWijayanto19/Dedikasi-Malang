<?php

namespace Database\Seeders;

use App\Models\Cerita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       $ceritas = [
            [
                'title'          => 'Revitalisasi Pasar Tradisional Berbasis Komunitas',
                'deskripsi'      => 'Kisah sukses sebuah pasar tradisional yang direvitalisasi, bukan hanya fisiknya, tetapi juga sistem manajemennya, melibatkan komunitas lokal dan menggunakan aplikasi digital untuk pemesanan.',
                'nama_penulis'   => 'Siti Hajar',
                'jabatan'        => 'Pengembang Komunitas',
                'gambar'         => 'https://picsum.photos/seed/pasar/300/200',
                'created_at'     => Carbon::now()->subDays(2),
                'updated_at'     => Carbon::now()->subDays(2),
            ],
            [
                'title'          => 'Program Beasiswa Daerah Mencetak Generasi Unggul',
                'deskripsi'      => 'Cerita inspiratif tentang dampak program beasiswa yang didanai pemerintah daerah terhadap puluhan siswa berprestasi dari keluarga kurang mampu, mengubah masa depan mereka.',
                'nama_penulis'   => 'Dr. Harun Al-Rasyid',
                'jabatan'        => 'Kepala Dinas Pendidikan',
                'gambar'         => 'https://picsum.photos/seed/siswa/300/200',
                'created_at'     => Carbon::now()->subDays(7),
                'updated_at'     => Carbon::now()->subDays(7),
            ],
            [
                'title'          => 'Inisiatif Desa Bebas Sampah Plastik',
                'deskripsi'      => 'Sebuah inisiatif desa yang berhasil melarang penggunaan kantong plastik sekali pakai dan mengimplementasikan bank sampah terpadu.  Hasilnya, lingkungan desa menjadi jauh lebih bersih dan indah.',
                'nama_penulis'   => 'Dewi Kartika',
                'jabatan'        => 'Pegiat Lingkungan',
                'gambar'         => 'https://picsum.photos/seed/sampah/300/200',
                'created_at'     => Carbon::now()->subDays(15),
                'updated_at'     => Carbon::now()->subDays(15),
            ],
            [
                'title'          => 'Peningkatan Kualitas Infrastruktur Jalan Desa',
                'deskripsi'      => 'Laporan mengenai proyek pembangunan jalan yang selesai tepat waktu dan mutu, meningkatkan konektivitas antar desa dan mempermudah transportasi hasil pertanian warga.',
                'nama_penulis'   => 'Andi Wijaya',
                'jabatan'        => 'Kepala Bidang Pekerjaan Umum',
                'gambar'         => 'https://picsum.photos/seed/jalan/300/200',
                'created_at'     => Carbon::now()->subDays(4),
                'updated_at'     => Carbon::now()->subDays(4),
            ],
            [
                'title'          => 'Digitalisasi Arsip Layanan Administrasi',
                'deskripsi'      => 'Membahas langkah-langkah kantor camat dalam mendigitalisasi semua arsip layanan, mengurangi penggunaan kertas, dan mempercepat proses pencarian dokumen penting.',
                'nama_penulis'   => 'Fajar Setiawan',
                'jabatan'        => 'Staff Administrasi',
                'gambar'         => 'https://picsum.photos/seed/arsip/300/200',
                'created_at'     => Carbon::now()->subDays(9),
                'updated_at'     => Carbon::now()->subDays(9),
            ],
            [
                'title'          => 'Pertanian Organik sebagai Pilar Ekonomi Baru',
                'deskripsi'      => 'Strategi dan implementasi pertanian organik di lahan kas desa yang tidak hanya meningkatkan pendapatan petani tetapi juga menjamin ketahanan pangan yang sehat bagi masyarakat.',
                'nama_penulis'   => 'Dr. Lia Pramesti',
                'jabatan'        => 'Penyuluh Pertanian',
                'gambar'         => 'https://picsum.photos/seed/pertanian/300/200',
                'created_at'     => Carbon::now()->subDays(1),
                'updated_at'     => Carbon::now()->subDays(1),
            ],
            [
                'title'          => 'Pelatihan Keterampilan Wirausaha untuk Ibu Rumah Tangga',
                'deskripsi'      => 'Program pemberdayaan yang memberikan pelatihan menjahit, membuat kerajinan, dan pemasaran daring kepada ibu-ibu, membantu mereka mendapatkan penghasilan tambahan dari rumah.',
                'nama_penulis'   => 'Ratna Sari',
                'jabatan'        => 'Ketua PKK',
                'gambar'         => 'https://picsum.photos/seed/menjahit/300/200',
                'created_at'     => Carbon::now()->subDays(12),
                'updated_at'     => Carbon::now()->subDays(12),
            ],
            [
                'title'          => 'Pengembangan Wisata Alam Lokal Berkelanjutan',
                'deskripsi'      => 'Upaya pemerintah desa dalam mengembangkan potensi air terjun dan hutan lokal menjadi destinasi wisata, dengan fokus pada konservasi lingkungan dan pemberdayaan pemuda sebagai pemandu wisata.',
                'nama_penulis'   => 'Teguh Widodo',
                'jabatan'        => 'Kepala Seksi Pariwisata',
                'gambar'         => 'https://picsum.photos/seed/wisata/300/200',
                'created_at'     => Carbon::now()->subDays(6),
                'updated_at'     => Carbon::now()->subDays(6),
            ],
        ];

        foreach ($ceritas as $data) {
            Cerita::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'deskripsi' => $data['deskripsi'],
                'gambar' => $data['gambar'],
                'jabatan' => $data['jabatan'],
                'nama_penulis' => $data['nama_penulis'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
