<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laporan extends Model
{
    use HasFactory;
    protected $table = 'laporan';
    protected $fillable = ['pelapor_id', 'media_pengaduan', 'tanggal_pelaporan', 'tanggal_kejadian', 'tempat_kejadian', 'alamat_kejadian', 'rt', 'rw', 'desa_kelurahan', 'kecamatan', 'kabupaten_kota', 'provinsi', 'difabel', 'kdrt', 'tppo', 'jenis_kasus', 'kronologi', 'bukti_path', 'status', 'admin_id'];

    protected $casts = [
        'jenis_kasus' => 'array',
        'difabel' => 'boolean',
        'kdrt' => 'boolean',
        'tppo' => 'boolean',
    ];

    // Relasi
    public function pelaporUser()
    {
        return $this->belongsTo(User::class, 'pelapor_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function pelapor()
    {
        return $this->hasOne(Pelapor::class);
    }

    public function terlapor()
    {
        return $this->hasOne(Terlapor::class);
    }

    public function korban()
    {
        return $this->hasOne(Korban::class);
    }

    public function tugas()
    {
        return $this->hasOne(TugasLaporan::class);
    }

    public function konsultasi()
    {
        return $this->hasOne(Konsultasi::class);
    }
}
