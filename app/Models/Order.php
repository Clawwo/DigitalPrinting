<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'email', 'no_hp', 'kategori', 'jenis', 'deskripsi', 'file_desain', 'estimasi_jadi',];
    protected $casts = [
        'tanggal_pemesanan' => 'datetime',
    ];
}
