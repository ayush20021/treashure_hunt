<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treasure extends Model
{
    //

    public function images()
    {
        return $this->hasMany(TreasureImage::class);
    }
}
