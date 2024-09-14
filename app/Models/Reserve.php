<?php

namespace App\Models;

use App\Helpers\DateConvertor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Morilog\Jalali\Jalalian;

class Reserve extends Model
{
    use HasFactory;
    protected $fillable=[
        "user_id",
        "room_id",
        "start",
        "end"
    ];
    public $appends=["room_number","room_floor","start_shamsi","end_shamsi"];

    public function room(){
        return $this->BelongsTo(Room::class);
    }

    public function user(){
        return $this->BelongsTo(User::class);
    }

    public function getRoomNumberAttribute(){
        return $this->room->number;
    }
    public function getRoomFloorAttribute(){
        return $this->room->floor;
    }

    public function getStartShamsiAttribute(){
        return Jalalian::fromDateTime($this->start)->format("Y/m/d");
    }

    public function getEndShamsiAttribute(){
        return Jalalian::fromDateTime($this->end)->format("Y/m/d");
    }


}
