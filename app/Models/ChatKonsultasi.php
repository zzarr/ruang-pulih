<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatKonsultasi extends Model
{
    use HasFactory;
    protected $table = 'chat_konsultasi';
    protected $fillable = ['konsultasi_id', 'pengirim_id', 'pesan', 'tipe', 'file_path'];

    public $timestamps = false;
    protected $dates = ['created_at', 'updated_at']; // optional, Carbon otomatis

    // Relasi
    public function konsultasi()
    {
        return $this->belongsTo(Konsultasi::class);
    }

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }
}
