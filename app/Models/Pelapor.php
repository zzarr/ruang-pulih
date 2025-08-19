<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelapor extends Model
{
    use HasFactory;

    protected $table = 'pelapor';
    protected $fillable = [
        'laporan_id', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'usia',
        'alamat', 'desa_kelurahan', 'kecamatan', 'kota_kabupaten', 'provinsi',
        'jenis_kelamin', 'agama', 'pendidikan', 'pekerjaan', 'jenis_pekerjaan',
        'status_perkawinan', 'no_telepon'
    ];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }
}
