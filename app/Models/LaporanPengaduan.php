<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPengaduan extends Model
{
    /** @use HasFactory<\Database\Factories\LaporanPengaduanFactory> */
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'kategori_id',
        'lokasi_id',
        'sarana_id',
        'ket',
        'lokasi',
        'gambar',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function lokasiRef()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }

    public function sarana()
    {
        return $this->belongsTo(Sarana::class);
    }

    public function aspirasi()
    {
        return $this->hasOne(Aspirasi::class, 'laporan_id');
    }
}
