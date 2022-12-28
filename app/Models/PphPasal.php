<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PphPasal extends Model
{
    use HasFactory;
    protected $table = 'pphpasal';
    protected $fillable = [
        'tahun_pajak',
        'masa_pajak',
        'npwp',
        'nama',
        'identitas',
        'no_identitas',
        'qq',
        'kode_objek_pajak',
        'fasilitas_pajak_penghasilan',
        'no_fasilitas',
        'jumlah_penghasilan_bruto',
        'tarif',
        'jumlah_setor',
        'pengaturan_id',
        'no_bukti',
        'status',
        
    ];
    
}
