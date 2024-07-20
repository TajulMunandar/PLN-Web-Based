<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoAsset extends Model
{
    use HasFactory;

    use HasFactory;

    protected $guarded = ['id'];

    public function assets()
    {
        return $this->hasMany(Asset::class, 'id_asset');
    }
}
