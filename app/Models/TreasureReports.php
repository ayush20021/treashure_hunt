<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TreasureReports extends Model
{
    //

    public  function treasure()
    {
        return $this->belongsTo(Treasure::class,'treasure_id');
    }

    protected $fillable = [
        'treasure_id',
        'report_reason',
        'additional_details' ,
        'user_id' ,
    ];


}
