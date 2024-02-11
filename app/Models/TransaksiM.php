<?php

namespace App\Models;

use App\Models\DetailTransaksiM;
use App\Models\ProdukM;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiM extends Model
{
    use HasFactory;
    
    protected $table = 'transactions';
    protected $appends = ['nomor_unik'];
    protected $fillable = [
        'nama_pelanggan','nomor_unik','meja','uang_bayar','uang_kembali','pilihan_makan'
    ];
    public function produk()
    {
        return $this->hasMany(DetailTransaksiM::class, 'id_transaction');
    }
    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksiM::class, 'id_transaction');
    }

}
