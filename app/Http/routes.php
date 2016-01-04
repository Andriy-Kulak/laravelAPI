<?php


Route::group(array('prefix' => 'api'), function() {

    // CRUD  for Car Maker data
    Route::resource('makers', 'MakerController', ['except' => ['create', 'edit']]);

    //Controller for viewing vehicles data
    Route::resource('vehicles', 'VehicleController', ['only' => ['index']]);

    //CRUD for Car Vehicles data for specific makers
    Route::resource('makers.vehicles', 'MakerVehiclesController', ['except' => ['edit', 'create']]);

});

/**
 * In order to use the API, use Postman extension Chrome and use http://local.larapi.com/api/ as
 * your URI.
 *
 * To take a look at current available...
 *      vehicles: GET request http://local.larapi.com/api/vehicles
 *      makers: GET request http://local.larapi.com/api/makers
 *
 * To create,update delete car makers...
 *      - POST, PUT, DELETE request in http://local.larapi.com/api/makers
 *      - name and phone field will be required when creating a new entry
 *
 * To create,update delete vehicles of specific car makers...
 *      - POST, PUT, DELETE request in http://local.larapi.com/api/makers/{m-id}/vehicles/{v-id}
 *      - several attributes will be required when adding a new entry
 *
 */