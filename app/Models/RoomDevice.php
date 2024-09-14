<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomDevice extends Model
{
    use HasFactory;
    protected $fillable=[
        "number",
        "device_id",
        "room_id"
    ];

    public $appends=["device_name"];


    public function device(){
        return $this->belongsTo(Device::class,);
    }
    public function getDeviceNameAttribute(){
        return $this->device->name;
    }
    // public function getRoomFloorAttribute(){
    //     return $this->room->floor;
    // }


}
