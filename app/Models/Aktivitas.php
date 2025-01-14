<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'shift',
        'mulai_kerja',
        'selesai_kerja',
        'aktivitas',
        'photo',
    ];
}
