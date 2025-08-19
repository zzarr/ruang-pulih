<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Korban extends Model
{
    use HasFactory;
    protected $table = 'korban';
    protected $fillable = [
        'laporan_id', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'usia',
        'alamat', 'desa_kelurahan', 'kecamatan', 'kota_kabupaten', 'provinsi',
        'jenis_kelamin', 'agama', 'pendidikan', 'pekerjaan', 'status_perkawinan',
        'hubungan_pelapor'
    ];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }
}
