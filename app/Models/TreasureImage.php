<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TreasureImage extends Model
{
    //
    public function treasure()
    {
        return $this->belongsTo(Treasure::class);
    }

    protected $fillable = [
        'treasure_id',
        'path'

    ];

}
