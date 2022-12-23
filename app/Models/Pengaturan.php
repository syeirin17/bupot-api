<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    use HasFactory;
    protected $table = 'pengaturan';
    protected $fillable = [
        'bertindak_sebagai',
        'identitas',
        'status',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
