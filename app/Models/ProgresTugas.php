<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgresTugas extends Model


{
    protected $table = 'progres_tugas';
    public $timestamps = false;

    protected $fillable = ['tugas_id', 'deskripsi_tindak_lanjut', 'bukti_path'];

    public function tugas(): BelongsTo {
        return $this->belongsTo(TugasLaporan::class, 'tugas_id');
    }
}
