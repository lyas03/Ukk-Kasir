<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class MejaM extends Model
{
    use HasFactory;

    protected $table = 'meja';
    protected $fillable = [
        'no_meja', 'jumlah_kursi', 'status'
    ];
}
