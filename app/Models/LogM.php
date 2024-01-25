<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogM extends Model
{
    use HasFactory;

    protected $table = 'log';
    protected $fillable = [
        'id_user', 'activity'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
