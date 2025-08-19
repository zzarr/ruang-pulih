<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisKasus extends Model
{
    
    protected $table = 'jenis_kasus';


    protected $fillable = ['nama', 'deskripsi'];

    /**
     * Get the reports associated with this case type.
     */
    
}
