<?php

namespace App\Models;

use App\Models\KategoriM;
use App\Models\TransaksiM;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProdukM extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id_produk';
    protected $fillable = ['id_kategori','nama_produk', 'harga_produk','stok'];

    public function transactions()
    {
        return $this->hasMany(TransaksiM::class, 'id');
    }
    public function kategori()
    {
        return $this->belongsTo(KategoriM::class, 'id_kategori', 'id_kategori');
    }
    public function detailTransaksi()
    {
        return $this->hasOne(DetailTransaksiM::class, 'id_produk', 'id_produk');
    }

}
