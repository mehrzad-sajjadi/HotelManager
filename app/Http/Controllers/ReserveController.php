<?php

namespace App\Http\Controllers;

use App\Helpers\DateConvertor;
use App\Http\Requests\ReserveRequest;
use App\Models\Reserve;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Morilog\Jalali\Jalalian;

class ReserveController extends Controller
{
    public function index(){
        $start_time =Jalalian::now()->format("Y/m/d");
        $user_id = Auth::id();
        $rooms = Room::all();
        return Inertia::render("reserve/index",compact("user_id","rooms","start_time"));
    }


    public function store(ReserveRequest $reserveRequest){
        $start = DateConvertor::shamsi2miladi( $reserveRequest->start);
        $end = DateConvertor::shamsi2miladi($reserveRequest->end);
        $room = Reserve::where("room_id",$reserveRequest->room_id)->get()->toArray();

        $reserve = new Reserve();
        $reserve->user_id = $reserveRequest->user_id;
        $reserve->room_id = $reserveRequest->room_id;
        $reserve->start = $start;
        $reserve->end = $end;


        if($room){
            $check = Reserve::whereDate("start",">=",$start)->whereDate("start","<=",$end)->orWhereDate("start","<=",$end)->whereDate("end",">=",$end)->orWhereDate("start","<=",$start)->whereDate("end",">=",$start)->get()->toArray();
            if($check){
                return redirect()->back()->withErrors("Unfortunately, this room has already been booked for this date range !");
            }else{
                $reserve->save();
                return redirect()->back()->with("message","Welcom to Our Hotel");    
            }
        }else{
            $reserve->save();
            return redirect()->back()->with("message","Welcom to Our Hotel");
        }


    }


    public function delete(Reserve $reserve){
        if( $reserve->user_id == Auth::id() ){
            $reserve->delete();
            return redirect()->route("dashboard")->with("message","رزرو شما حذف شد !");    
        }else{
            return redirect()->back()->withErrors("You dont have allow to delete ");
        }


    }


}
