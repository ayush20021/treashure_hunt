<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TreasureVote extends Model
{
    //

    protected $fillable = [
        'vote_type',
        'user_id'
    ];
}
