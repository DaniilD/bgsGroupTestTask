<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //Таблица к которой привязана модель
    protected $table = "members";
    protected $fillable = ["name", "last_name", "email", "event_id"];

    //связь один ко многим.
    public function event(){
        return $this->belongsTo(Event::class, "event_id");
    }

    //создание нового участника в базе данных
    public static function add($fields){
        $member = new static;
        $member->fill($fields);
        $member->save();
        return $member;
    }
}
