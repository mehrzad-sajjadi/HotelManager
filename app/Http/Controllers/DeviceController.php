<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeviceRequest;
use App\Models\Device;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DeviceController extends Controller
{


    public function index(){
        $devices = Device::all();
        return Inertia::render("device/index",compact("devices"));
    }

    public function create(){
        return Inertia("device/create");
    }

    public function store(DeviceRequest $deviceRequest){
        $device = new Device();
        $device->name = $deviceRequest->name;
        $check = Device::where("name",$deviceRequest->name)->get()->toArray();
        if($check ){
            return redirect()->route("device_create")->with("error","وسیله مورد نظر قبلا به لیست وسایل اضافه شده ! ");
        }else{
            $device->save();
            return redirect()->route("device_index")->with("message","وسیله مورد نظر اضافه شد");
        }
    }

    // public function edit(Device $device){   
    //     return Inertia::render("device/edit",compact("device"));
    // }

    public function delete(Device $device){
        $device->delete();
    }


    // public function update(DeviceRequest $deviceRequest,Room $room){
    // }

    // public function show(Device $device){
    //     return Inertia::render("device/show",compact("room"));
    // }

}
