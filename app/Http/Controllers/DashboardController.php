<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(){
        $id = Auth::id();
        $rooms = Reserve::where("user_id",$id)->get()->toArray();
        return Inertia::render('Dashboard',compact("rooms"));
    }

}
