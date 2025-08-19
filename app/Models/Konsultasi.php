<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Konsultasi extends Model
{
    use HasFactory;
    protected $table = 'konsultasi';

    protected $fillable = [
        'user_id','laporan_id', 'konselor_id', 'status', 'metode', 'jadwal', 'catatan', 'topik'
    ];

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function konselor()
    {
        return $this->belongsTo(User::class, 'konselor_id');
    }

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'laporan_id');
    }

    public function chats()
    {
        return $this->hasMany(ChatKonsultasi::class, 'konsultasi_id');
    }

    // ✅ Accessor untuk nama korban
    public function getNamaKorbanAttribute()
    {
        if ($this->laporan && $this->laporan->korban) {
            return $this->laporan->korban->nama_lengkap;
        }

        return $this->user ? $this->user->name : '-';
    }
}
