<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'kontak', 'alamat'
    ];

    protected $hidden = ['password', 'remember_token'];

    // Relasi
    public function konsultasi()
    {
        return $this->hasMany(Konsultasi::class, 'user_id');
    }

    public function konsultasiSebagaiKonselor()
    {
        return $this->hasMany(Konsultasi::class, 'konselor_id');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'pelapor_id');
    }

    public function tugasLaporan()
    {
        return $this->hasMany(TugasLaporan::class, 'petugas_id');
    }
}
