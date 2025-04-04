<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    use HasFactory;

    protected $table = 'tr_setoran';
    protected $primaryKey = 'id_setoran';

    protected $fillable = [
        'id_piutang',
        'tanggal_setor',
        'jumlah_setor',
        'id_penerima'
    ];

    public function piutang()
    {
        return $this->belongsTo(Piutang::class, 'id_piutang');
    }

    public function penerima()
    {
        return $this->belongsTo(Marketing::class, 'id_penerima');
    }
}

