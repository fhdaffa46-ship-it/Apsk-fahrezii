<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\LaporanPengaduan;
use App\Models\Lokasi;
use App\Models\Sarana;
use App\Models\Siswa;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = Admin::factory()->create([
            'nama' => 'Administrator',
            'username' => 'admin',
        ]);

        $kategori = collect([
            Kategori::create(['nama_kategori' => 'Ruang Kelas']),
            Kategori::create(['nama_kategori' => 'Toilet']),
            Kategori::create(['nama_kategori' => 'Laboratorium']),
            Kategori::create(['nama_kategori' => 'Perpustakaan']),
            Kategori::create(['nama_kategori' => 'Fasilitas Listrik']),
        ]);

        $siswa = Siswa::factory()->count(10)->create();

        $lokasi = collect([
            Lokasi::create(['nama_lokasi' => 'Ruang Kelas']),
            Lokasi::create(['nama_lokasi' => 'Laboratorium']),
            Lokasi::create(['nama_lokasi' => 'Perpustakaan']),
            Lokasi::create(['nama_lokasi' => 'Toilet']),
            Lokasi::create(['nama_lokasi' => 'Lapangan']),
        ]);

        $sarana = collect([
            Sarana::create(['nama_sarana' => 'Kursi']),
            Sarana::create(['nama_sarana' => 'Meja']),
            Sarana::create(['nama_sarana' => 'Papan Tulis']),
            Sarana::create(['nama_sarana' => 'Lampu']),
            Sarana::create(['nama_sarana' => 'Proyektor']),
        ]);

        $laporan = LaporanPengaduan::factory()
            ->count(15)
            ->make()
            ->each(function ($laporan) use ($siswa, $kategori, $lokasi, $sarana) {
                /** @var \App\Models\LaporanPengaduan $laporan */
                $laporan->siswa_id = $siswa->random()->id;
                $laporan->kategori_id = $kategori->random()->id;
                $lokasiTerpilih = $lokasi->random();
                $laporan->lokasi_id = $lokasiTerpilih->id;
                $laporan->lokasi = $lokasiTerpilih->nama_lokasi;
                $laporan->sarana_id = $sarana->random()->id;
                $laporan->save();
            });

        $laporan->each(function ($laporan) use ($admin) {
            Aspirasi::factory()->create([
                'laporan_id' => $laporan->id,
                'admin_id' => $admin->id,
            ]);
        });
    }
}
