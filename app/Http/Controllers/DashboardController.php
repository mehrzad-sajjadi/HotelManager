<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Morilog\Jalali\Jalalian;


class DashboardController extends Controller
{
    public function index(){
        $id = Auth::id();
        $rooms = Reserve::where("user_id",$id)->get()->map(function($record){
            if(Carbon::now() > $record->end ){
               $status = "غیر فعال"; 
            }else{
                $status = "فعال"; 
            }
            $end = $record->end;   // فرض بر این است که از نوع تاریخ است و تبدیل به Carbon شده
            $start = $record->start;
            
            $stay = $end->diffInDays($start);
            $array=[];
            $array["floor"]=["type"=>"text","data"=>$record->room_floor];
            $array["number"]=["type"=>"text","data"=>$record->room_number];
            $array["start"]=["type"=>"text","data"=>$record->start_shamsi];
            $array["end"]=["type"=>"text","data"=>$record->end_shamsi];
            $array["stay"]=["type"=>"text","data"=>$record->$stay];
            
            $array["status"]=["type"=>"text","data"=>$status];
            
            $array["button"]    = [ "type"=>"button",
            "items"=>[
                ["data"=>route('reserve.edit', $record->id)     ,  "method"=>"get"      ,"value"=>"ویرایش رزور"           , "type"=>"edit"        ],
                ["data"=>route("reserve_delete",$record->id)   ,  "method"=>"delete"   ,"value"=>"حذف رزرو"             , "type"=>"delete"      ],
            ],
        ];

            return $array;
        });
        $header = ["طبقه","شماره","شروع رزرو","پایان رزرو","روزهای اقامت","وضعیت","عملیات"];

        return Inertia::render('Dashboard',compact("rooms","header"));
    }

}
