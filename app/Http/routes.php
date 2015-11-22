<?php


Route::group(array('prefix' => 'api'), function() {

    // CRUD  for Car Maker data
    Route::resource('makers', 'MakerController', ['except' => ['create', 'edit']]);

    //Controller for viewing vehicles data
    Route::resource('vehicles', 'VehicleController', ['only' => ['index']]);

    //CRUD for Car Vehicles data for specific makers
    Route::resource('makers.vehicles', 'MakerVehiclesController', ['except' => ['edit', 'create']]);

});