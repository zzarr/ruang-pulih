<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TugasLaporan extends Model
{
    use HasFactory;
    protected $table = 'tugas_laporan';

    protected $fillable = [
        'laporan_id', 'petugas_id', 'jenis_tindak_lanjut', 'tanggal_tugas', 'catatan'
    ];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function progres()
    {
        return $this->hasMany(ProgresTugas::class, 'tugas_id');
    }
}
