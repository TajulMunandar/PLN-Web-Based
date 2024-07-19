<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'foto_asets';

    protected $guarded = ['id'];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'id_aset');
    }
}
