<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // kolom yang boleh diisi
    protected $fillable = [
        'username',
        'password',
        'panggilan',
    ];

    // sembunyikan password dari response JSON
    protected $hidden = [
        'password',
    ];

    // relasi: satu user punya banyak task
    public function tasks() {
        return $this->hasMany(Task::class);
    }
}
