<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Donasi;
use App\Enums\StatusPostingan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DonasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('donasis')->truncate();

        $donasiData = [
            [
                'title' => 'Bantu Korban Banjir Jakarta Awal Tahun',
                'deskripsi' => 'Penggalangan dana cepat untuk menyediakan kebutuhan pokok, makanan, dan obat-obatan bagi ribuan korban yang terdampak banjir di wilayah Jakarta.',
                'gambar' => 'https://picsum.photos/seed/donasi1/800/600',
                'link_donasi' => 'https://kitabisa.com/campaign/banjirjakarta',
                'status' => StatusPostingan::Publish,
            ],
            [
                'title' => 'Beasiswa Pendidikan Anak Yatim',
                'deskripsi' => 'Program beasiswa rutin untuk memastikan anak-anak yatim berprestasi dapat melanjutkan pendidikan mereka hingga jenjang perguruan tinggi.',
                'gambar' => 'https://picsum.photos/seed/donasi2/800/600',
                'link_donasi' => 'https://kitabisa.com/campaign/beasiswaanakyatim',
                'status' => StatusPostingan::Draft,
            ],
            [
                'title' => 'Bangun Musholla untuk Komunitas Pelosok',
                'deskripsi' => 'Mari ulurkan tangan untuk membangun fasilitas ibadah (Musholla) yang layak bagi komunitas di daerah terpencil yang belum memilikinya.',
                'gambar' => 'https://picsum.photos/seed/donasi3/800/600',
                'link_donasi' => 'https://kitabisa.com/campaign/bangunmusholla',
                'status' => StatusPostingan::Publish,
            ],
            [
                'title' => 'Operasi Mata Gratis untuk Kaum Dhuafa',
                'deskripsi' => 'Penggalangan dana untuk program operasi katarak dan gangguan mata lainnya secara gratis bagi masyarakat kurang mampu.',
                'gambar' => 'https://picsum.photos/seed/donasi4/800/600',
                'link_donasi' => 'https://kitabisa.com/campaign/operasimatagratis',
                'status' => StatusPostingan::Publish,
            ],
            [
                'title' => 'Donasi Makanan Hewan Terlantar',
                'deskripsi' => 'Bantuan untuk shelter hewan terlantar dalam menyediakan makanan, vitamin, dan perawatan kesehatan rutin bagi ratusan kucing dan anjing.',
                'gambar' => 'https://picsum.photos/seed/donasi5/800/600',
                'link_donasi' => 'https://kitabisa.com/campaign/makananhewan',
                'status' => StatusPostingan::Draft,
            ],
            [
                'title' => 'Bantu Korban Banjir Jakarta Awal Tahun',
                'deskripsi' => 'Penggalangan dana cepat untuk menyediakan kebutuhan pokok, makanan, dan obat-obatan bagi ribuan korban yang terdampak banjir di wilayah Jakarta.',
                'gambar' => 'https://picsum.photos/seed/donasi1/800/600',
                'link_donasi' => 'https://kitabisa.com/campaign/banjirjakarta',
                'status' => StatusPostingan::Publish,
            ],
            [
                'title' => 'Beasiswa Pendidikan Anak Yatim',
                'deskripsi' => 'Program beasiswa rutin untuk memastikan anak-anak yatim berprestasi dapat melanjutkan pendidikan mereka hingga jenjang perguruan tinggi.',
                'gambar' => 'https://picsum.photos/seed/donasi2/800/600',
                'link_donasi' => 'https://kitabisa.com/campaign/beasiswaanakyatim',
                'status' => StatusPostingan::Draft,
            ],
            [
                'title' => 'Bangun Musholla untuk Komunitas Pelosok',
                'deskripsi' => 'Mari ulurkan tangan untuk membangun fasilitas ibadah (Musholla) yang layak bagi komunitas di daerah terpencil yang belum memilikinya.',
                'gambar' => 'https://picsum.photos/seed/donasi3/800/600',
                'link_donasi' => 'https://kitabisa.com/campaign/bangunmusholla',
                'status' => StatusPostingan::Publish,
            ],
        ];

        foreach ($donasiData as $data) {
            Donasi::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']) . '-' . time(),
                'deskripsi' => $data['deskripsi'],
                'gambar' => $data['gambar'],
                'link_donasi' => $data['link_donasi'],
                'status' => $data['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
