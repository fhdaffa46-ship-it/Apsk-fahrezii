<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\Sarana;
use App\Models\Siswa;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LaporanPengaduan>
 */
class LaporanPengaduanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $lokasi = Lokasi::inRandomOrder()->first();

        return [
            'siswa_id' => Siswa::factory(),
            'kategori_id' => Kategori::inRandomOrder()->first()?->id,
            'lokasi_id' => $lokasi?->id,
            'sarana_id' => Sarana::inRandomOrder()->first()?->id,
            'ket' => $this->faker->sentence(12),
            'lokasi' => $lokasi?->nama_lokasi ?? 'Ruang Kelas',
        ];
    }
}
