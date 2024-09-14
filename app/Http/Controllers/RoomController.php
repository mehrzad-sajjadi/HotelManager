<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Room;
use App\Models\RoomDevice;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoomController extends Controller
{
    public function index(){
        $rooms = Room::all();
        return Inertia::render("room/index",compact("rooms"));
    }
    public function create(){
        return Inertia::render("room/create");
    }

    public function store(RoomRequest $roomRequest){
        $room = new Room();
        $room->floor = $roomRequest->floor ;
        $room->number = $roomRequest->number ;
        $room->price = $roomRequest->price ;

        $check = Room::where("floor",$room->floor)->where("number",$room->number )->get()->toArray();

        if($check){
            return redirect()->route("room_create")->with("error","این اتاق قبلا با همین شماره در همین طبقه ایجاد شده است !");
        }else{
            $room->save();
            return redirect()->route("room_index")->with("message","اتاق شما با موفقیت ایجاد شد");
        }
    }

    public function edit(Room $room){   
        return Inertia::render("room/edit",compact("room"));
    }

    public function delete($id){
        $room = Room::findOrFail($id);
        $room->delete();
    }


    public function update(RoomRequest $roomRequest,Room $room){
        $room->floor = $roomRequest->floor ;
        $room->number = $roomRequest->number ;
        $room->price = $roomRequest->price ;

        $check = Room::where("floor",$room->floor)->where("number",$room->number )->get()->toArray();

        if($check){
            return redirect()->route("room_edit",$room->id)->with("error","این اتاق قبلا با همین شماره در همین طبقه ایجاد شده است !");
        }else{
            $room->save();
            return redirect()->route("room_index")->with("message","اتاق شما با موفقیت ویرایش شد");
        }    
    }

    public function show(Room $room){
        $room_devices = RoomDevice::where("room_id",$room->id)->get()->toArray();

        return Inertia::render("room/show",compact("room_devices","room"));
    }

}
