<?php


Route::group(array('prefix' => 'api'), function() {
    Route::resource('makers', 'MakerController', ['except' => ['create', 'edit']]);


    Route::resource('vehicles', 'VehicleController', ['only' => ['index']]);


    Route::resource('makers.vehicles', 'MakerVehiclesController', ['except' => ['edit', 'create']]);

});