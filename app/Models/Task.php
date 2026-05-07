<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // kolom yang boleh diisi
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

    // relasi: task milik satu user
    public function user() {
        return $this->belongsTo(User::class);
    }
}
