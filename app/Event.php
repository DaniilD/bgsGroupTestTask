<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = "events";

    //связь один ко многим.
    public function member(){
        return $this->hasMany(Member::class,"event_id");
    }

}
