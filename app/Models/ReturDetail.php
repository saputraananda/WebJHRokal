<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturDetail extends Model
{
    use HasFactory;

    protected $table = 'tr_retur_detail';
    protected $primaryKey = 'id_retur';

    protected $fillable = [
        'id_transaksi',
        'id_roti',
        'jumlah_retur',
        'total_retur',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    public function roti()
    {
        return $this->belongsTo(Roti::class, 'id_roti');
    }
}

