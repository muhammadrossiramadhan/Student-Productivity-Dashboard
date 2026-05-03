<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     * Ini adalah semua kolom dari tabel tasks kita.
     */
    protected $fillable = [
        'user_id',
        'nama_tugas',
        'deskripsi',
        'deadline',
        'waktu',
        'prioritas',
        'status',
        'selesai_at',
        'poin_konsistensi',
    ];

    /**
     * Mendefinisikan relasi: Satu Task dimiliki oleh satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
