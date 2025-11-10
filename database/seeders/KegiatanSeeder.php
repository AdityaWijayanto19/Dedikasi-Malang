<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kegiatan;
use App\Enums\StatusPostingan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kegiatans')->truncate();

        $kegiatanData = [
            [
                'batch' => 'Dedikasi Batch 1',
                'title' => 'Workshop Laravel Dasar untuk Pemula',
                'deskripsi' => 'Kegiatan ini bertujuan untuk memperkenalkan dasar-dasar framework Laravel kepada para pengembang web pemula. Peserta akan belajar tentang routing, controller, model, dan view.',
                'tanggal' => '2024-03-15',
                'gambar' => 'https://picsum.photos/seed/kegiatan1/800/600',
                'lokasi' => 'Gedung Serbaguna, Jakarta',
                'link_dokumentasi' => 'https://docs.google.com/document/d/example1',
                'status' => StatusPostingan::Publish,
            ],
            [
                'batch' => 'Dedikasi Batch 2',
                'title' => 'Seminar Digital Marketing: SEO & SEM',
                'deskripsi' => 'Seminar mendalam tentang strategi pemasaran digital dengan fokus pada Search Engine Optimization (SEO) dan Search Engine Marketing (SEM) untuk meningkatkan visibilitas bisnis online.',
                'tanggal' => '2024-04-22',
                'gambar' => 'https://picsum.photos/seed/kegiatan2/800/600',
                'lokasi' => 'Hotel Bintang Lima, Surabaya',
                'link_dokumentasi' => 'https://docs.google.com/document/d/example2',
                'status' => StatusPostingan::Publish,
            ],
            [
                'batch' => 'Dedikasi Batch 3',
                'title' => 'Pelatihan UI/UX Design dengan Figma',
                'deskripsi' => 'Pelatihan intensif selama 3 hari untuk menguasai alat desain Figma, mulai dari dasar hingga membuat prototipe interPublish untuk aplikasi mobile dan web.',
                'tanggal' => '2024-05-10',
                'gambar' => 'https://picsum.photos/seed/kegiatan3/800/600',
                'lokasi' => 'Co-working Space Kreatif, Bandung',
                'link_dokumentasi' =>'https://docs.google.com/document/d/example2',
                'status' => StatusPostingan::Publish,
            ],
            [
                'batch' => 'Dedikasi Batch 4',
                'title' => 'Talkshow Kewirausahaan di Era Digital',
                'deskripsi' => 'Acara bincang-bincang inspiratif bersama para pendiri startup sukses yang akan membagikan pengalaman dan tips dalam membangun bisnis di era digital.',
                'tanggal' => '2024-06-05',
                'gambar' => 'https://picsum.photos/seed/kegiatan4/800/600',
                'lokasi' => 'Aula Universitas Nasional, Yogyakarta',
                'link_dokumentasi' => 'https://docs.google.com/document/d/example4',
                'status' => StatusPostingan::Draft,
            ],
            [
                'batch' => 'Dedikasi Batch 5',
                'title' => 'Bootcamp Full-Stack JavaScript (MERN)',
                'deskripsi' => 'Program bootcamp intensif selama 3 bulan untuk menjadi seorang Full-Stack Developer dengan teknologi MongoDB, Express.js, React, dan Node.js.',
                'tanggal' => '2024-07-01',
                'gambar' => 'https://picsum.photos/seed/kegiatan5/800/600',
                'lokasi' => 'Online via Zoom',
                'link_dokumentasi' => 'https://docs.google.com/document/d/example5',
                'status' => StatusPostingan::Publish,
            ],
            [
                'batch' => 'Dedikasi Batch 6',
                'title' => 'Kompetisi Hackathon: Solusi Cerdas Perkotaan',
                'deskripsi' => 'Ajang kompetisi 24 jam bagi para developer, desainer, dan inovator untuk menciptakan solusi teknologi guna mengatasi masalah perkotaan.',
                'tanggal' => '2024-08-17',
                'gambar' => 'https://picsum.photos/seed/kegiatan6/800/600',
                'lokasi' => 'Gedung Inovasi, Tangerang',
                'link_dokumentasi' => 'https://docs.google.com/document/d/example2',
                'status' => StatusPostingan::Publish,
            ],
            [
                'batch' => 'Dedikasi Batch 7',
                'title' => 'Webinar Keamanan Siber untuk UMKM',
                'deskripsi' => 'Webinar gratis untuk pemilik Usaha Mikro, Kecil, dan Menengah (UMKM) tentang pentingnya keamanan siber dan cara melindungi bisnis dari serangan digital.',
                'tanggal' => '2024-09-12',
                'gambar' => 'https://picsum.photos/seed/kegiatan7/800/600',
                'lokasi' => 'Online via YouTube Live',
                'link_dokumentasi' => 'https://docs.google.com/document/d/example7',
                'status' => StatusPostingan::Publish,
            ],
            [
                'batch' => 'Dedikasi Batch 8',
                'title' => 'Pameran Fotografi: Wajah Indonesia',
                'deskripsi' => 'Pameran yang menampilkan karya-karya fotografi terbaik yang menangkap keragaman budaya dan keindahan alam Indonesia dari berbagai sudut pandang.',
                'tanggal' => '2024-10-28',
                'gambar' => 'https://picsum.photos/seed/kegiatan8/800/600',
                'lokasi' => 'Galeri Seni Nasional, Jakarta Pusat',
                'link_dokumentasi' => 'https://docs.google.com/document/d/example8',
                'status' => StatusPostingan::Draft,
            ],
            [
                'batch' => 'Dedikasi Batch 9',
                'title' => 'Pelatihan Manajemen Proyek Agile & Scrum',
                'deskripsi' => 'Workshop dua hari yang akan membekali peserta dengan pengetahuan dan keterampilan praktis untuk mengelola proyek menggunakan metodologi Agile dan framework Scrum.',
                'tanggal' => '2025-01-20',
                'gambar' => 'https://picsum.photos/seed/kegiatan9/800/600',
                'lokasi' => 'Hotel Aston, Semarang',
                'link_dokumentasi' => 'https://docs.google.com/document/d/example2',
                'status' => StatusPostingan::Publish,
            ],
            [
                'batch' => 'Dedikasi Batch 10',
                'title' => 'Festival Kuliner Nusantara',
                'deskripsi' => 'Sebuah festival yang merayakan kekayaan kuliner Indonesia dengan menghadirkan lebih dari 100 jenis makanan dan minuman tradisional dari seluruh nusantara.',
                'tanggal' => '2025-02-14',
                'gambar' => 'https://picsum.photos/seed/kegiatan10/800/600',
                'lokasi' => 'Lapangan Banteng, Jakarta',
                'link_dokumentasi' => 'https://docs.google.com/document/d/example10',
                'status' => StatusPostingan::Publish,
            ],
        ];

        foreach ($kegiatanData as $data) {
            Kegiatan::create([
                'batch' => $data['batch'],
                'title' => $data['title'],
                'slug' => Str::slug($data['batch'] . '-' . $data['title']),
                'deskripsi' => $data['deskripsi'],
                'tanggal' => $data['tanggal'],
                'gambar' => $data['gambar'],
                'lokasi' => $data['lokasi'],
                'link_dokumentasi' => $data['link_dokumentasi'],
                'status' => $data['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
