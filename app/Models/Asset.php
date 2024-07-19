<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $table = 'assets';

    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function fotoAset()
    {
        return $this->hasMany(FotoAsset::class, 'id_aset');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_aset');
    }
}
