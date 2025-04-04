<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketing extends Model
{
    use HasFactory;

    protected $table = 'mst_marketing';
    protected $primaryKey = 'id_marketing';
    protected $fillable = ['nama_marketing', 'is_penerima_setoran'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_marketing');
    }
}
