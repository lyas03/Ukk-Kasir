<?php

namespace App\Models;

use App\Models\TransaksiM;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProdukM extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = ['nama_produk', 'harga_produk', 'kategori'];

    public function transactions()
    {
        return $this->hasMany(TransaksiM::class, 'id_produk');
    }

    public static function getEnumKategori()
    {
        // Replace 'kategori' with the actual name of your enum column
        return ['makanan', 'minuman'];
    }
}
