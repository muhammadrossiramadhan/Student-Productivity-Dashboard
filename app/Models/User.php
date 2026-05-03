<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi secara massal (mass assignable).
     */
    protected $fillable = [
        'username',
        'password',
        'panggilan',
    ];

    /**
     * Kolom yang harus disembunyikan saat diubah menjadi array/JSON.
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Mendefinisikan relasi: Satu User bisa memiliki banyak Task.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
