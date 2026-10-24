<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sarana extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_sarana',
    ];

    public function laporanPengaduans()
    {
        return $this->hasMany(LaporanPengaduan::class);
    }
}
