<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roti extends Model
{
    use HasFactory;

    protected $table = 'mst_roti';
    protected $primaryKey = 'id_roti';

    protected $fillable = [
        'nama_roti',
        'harga_satuan'
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_roti');
    }
}

