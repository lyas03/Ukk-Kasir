<?php

namespace App\Models;

use App\Models\ProdukM;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiM extends Model
{
    use HasFactory;
    
    protected $table = 'transactions';
    protected $fillable = [
        'id_produk', 'qty', 'nama_pelanggan','nomor_unik','meja','uang_bayar','uang_kembali'
    ];
    public function produk()
    {
        return $this->belongsTo(ProdukM::class, 'no_produk', 'id');
    }

}