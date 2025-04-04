<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piutang extends Model
{
    use HasFactory;

    protected $table = 'tr_piutang';
    protected $primaryKey = 'id_piutang';

    protected $fillable = [
        'id_transaksi',
        'total_piutang',
        'saldo_piutang',
        'status',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    public function setoran()
    {
        return $this->hasMany(Setoran::class, 'id_piutang');
    }
}

