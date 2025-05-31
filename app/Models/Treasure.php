<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Treasure extends Model
{
    //
    use Searchable;



    public function images()
    {
        return $this->hasMany(TreasureImage::class);
    }

    public function votes(){
        return $this->hasMany(TreasureVote::class);
    }

    public function treastrereports()
    {
        $this->hasMany(TreasureReports::class,'treasure_id');
    }

    public function getupvotesAttribute(){
        return $this->votes()->where('vote_type', 'up')->count();
    }
    public function getdownvotesAttribute(){
        return $this->votes()->where('vote_type', 'down')->count();
    }

    public function userVoteType()
    {
        $vote = $this->votes()
            ->where('user_id', auth()->id())
            ->first();

        return $vote ? $vote->vote_type : null;
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'location' => $this->location
        ];
    }

}
