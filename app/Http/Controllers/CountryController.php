<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CountryController extends Controller
{
    public function index(){
        $countries = Country::all();
        
        $cities = City::all();
        return Inertia::render("room/index",compact("cities","countries"));
    }
}
