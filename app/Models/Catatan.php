<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catatan extends Model
{
    /**
     * Nama tabel yang digunakan.
     */
    protected $table = 'catatan';

    /**
     * Kolom yang bisa diisi.
     */
    protected $fillable = ['user_id', 'judul', 'isi'];

    /**
     * Relasi ke pemilik catatan.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
