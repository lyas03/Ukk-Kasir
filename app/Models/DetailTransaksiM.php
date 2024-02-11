<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksiM extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksis';
    protected $fillable = [
        'id_transaction','id_produk','harga_produk','jumlah','total_harga'
    ];

    public function transaksi()
    {
        return $this->belongsTo(TransaksiM::class, 'id_transaction', 'id');
    }

    // Menyesuaikan relasi dengan model ProdukM
    public function produk()
    {
        return $this->belongsTo(ProdukM::class, 'id_produk', 'id_produk');
    }
}
