<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomDeviceRequest;
use App\Models\Device;
use App\Models\RoomDevice;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoomDeviceController extends Controller
{
    public function create($id){
        $devices = Device::all();
        return Inertia::render("room/add_device",compact("id","devices"));
    }


    public function store(RoomDeviceRequest $roomDeviceRequest){
        $roomDevice = new RoomDevice();
        $roomDevice->number = $roomDeviceRequest->number;
        $roomDevice->device_id = $roomDeviceRequest->device_id;
        $roomDevice->room_id = $roomDeviceRequest->room_id;

        $check= RoomDevice::where("room_id",$roomDevice->room_id)->where("device_id", $roomDevice->device_id)->get()->toArray();
        if($check){
            return redirect()->route("device_room_create",$roomDevice->room_id)->with("error","این وسیله قبلا به این اتاق اضافه شده است");
        }else{
            $roomDevice->save();
            return redirect()->route("room_show",$roomDevice->room_id)->with("message","وسیله مورد نظر با موفقیت به اتاق اضافه شد");    
        }
    }
}
