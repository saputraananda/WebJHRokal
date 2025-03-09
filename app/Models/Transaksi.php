<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'nama_marketing',
        'jumlah_pengambilan_roti',
        'harga_satuan',
        'total_harga',
        'jumlah_retur',
        'total_retur',
        'total_setoran',
        'uang_disetor',
        'sisa_piutang',
        'tanggal_setor',
        'penerima_setoran',
    ];
    
}
