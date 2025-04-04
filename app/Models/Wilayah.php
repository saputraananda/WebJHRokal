<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;

    protected $table = 'mst_wilayah';
    protected $primaryKey = 'id_toko';

    protected $fillable = [
        'nama_toko',
        'lokasi_toko',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_toko');
    }
}
