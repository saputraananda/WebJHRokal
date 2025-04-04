<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'tr_transaksi';
    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'tanggal',
        'id_marketing',
        'id_roti',
        'id_toko',
        'jumlah_pengambilan',
        'total_harga',
        'total_setoran',
        'total_retur',
        'status',
        'catatan'
    ];

    public function marketing()
    {
        return $this->belongsTo(Marketing::class, 'id_marketing');
    }

    public function roti()
    {
        return $this->belongsTo(Roti::class, 'id_roti');
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'id_toko');
    }

    public function retur()
    {
        return $this->hasOne(ReturDetail::class, 'id_transaksi');
    }

    public function piutang()
    {
        return $this->hasOne(Piutang::class, 'id_transaksi');
    }

}
