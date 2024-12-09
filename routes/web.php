<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomDeviceController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\register;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get("/slot",function(){
    return Inertia::render("slot");
});
Route::get("/profile2",function(){
    return Inertia::render("profileC");
});


Route::prefix("/room")->middleware(['auth', 'verified'])->group(function(){
    Route::get("/",[RoomController::class,"index"])->name("room_index");
    Route::get("/create",[RoomController::class,"create"])->name("room_create")->middleware(Admin::class);
    Route::post("/",[RoomController::class,"store"])->name("room_store")->middleware(Admin::class);
    Route::get("/{room}/edit",[RoomController::class,"edit"])->name("room_edit")->middleware(Admin::class);
    Route::get("/{room}/show",[RoomController::class,"show"])->name("room_show");
    Route::put("/{room}/update",[RoomController::class,"update"])->name("room_update")->middleware(Admin::class);
    Route::delete("/{room}/delete",[RoomController::class,"delete"])->name("room_delete")->middleware(Admin::class);
}
);


Route::prefix("/device_room")->middleware(['auth', 'verified',Admin::class])->group(function(){
    Route::get("{id}/create",[RoomDeviceController::class,"create"])->name("device_room_create");
    Route::get("{room_devices}/edit",[RoomDeviceController::class,"edit"])->name("device.room.edit");
    Route::put("{room_devices}/update",[RoomDeviceController::class,"update"])->name("device.room.update");
    Route::delete("{room_devices}/delete",[RoomDeviceController::class,"delete"])->name("device.room.delete");

    Route::post("/",[RoomDeviceController::class,"store"])->name("device_room_store");
}


);



Route::prefix("/device")->middleware(['auth', 'verified',Admin::class])->group(function(){
    Route::get("/",[DeviceController::class,"index"])->name("device_index");
    Route::get("/create",[DeviceController::class,"create"])->name("device_create");
    Route::post("/",[DeviceController::class,"store"])->name("device_store");
    Route::get("/{device}/edit",[DeviceController::class,"edit"])->name("device_edit");
    Route::get("/{device}/show",[DeviceController::class,"show"])->name("device_show");
    Route::put("/{device}/update",[DeviceController::class,"update"])->name("device_update");
    Route::delete("/{device}/delete",[DeviceController::class,"delete"])->name("device_delete");
}
);






Route::prefix("/reserve")->middleware(['auth', 'verified',register::class])->group(function(){
    Route::get("/",[ReserveController::class,"index"])->name("reserve_index");
    Route::post("/",[ReserveController::class,"store"])->name("reserve_store");
    Route::get("/{reserve}/edit",[ReserveController::class,"edit"])->name("reserve.edit");
    Route::delete("/{reserve}/delete",[ReserveController::class,"delete"])->name("reserve_delete");
})->name("reserve_group");





Route::prefix("country")->middleware(['auth', 'verified',register::class])->group(function(){
    Route::get("/", [CountryController::class,"index"])->name("country.index");
});




















Route::get('/', [ReserveController::class,"index"])->middleware(['auth', 'verified',register::class]);




Route::get('/dashboard', [DashboardController::class,"index"])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
