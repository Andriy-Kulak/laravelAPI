<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateVehicleRequest;
use App\Http\Controllers\Controller;
use App\Maker;
use App\Vehicle;
class MakerVehiclesController extends Controller
{
    public function __construct(){
        $this->middleware('auth.basis.once', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $maker = Maker::find($id);

        //if maker id is not found, error is displayed
        if(!$maker){
            return response()->json(['message' => 'This maker does not exist', 'code' => 404], 404);
        }

        return response()->json(['data' => $maker->vehicles], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateVehicleRequest $request, $makerId)
    {

        $maker = Maker::find($makerId);

        //if maker id is not found, error is displayed
        if(!$maker){
            return response()->json(['message' => 'This maker does not exist', 'code' => 404], 404);
        }

        $values = $request->all();

        $maker->vehicles()->create($values);

        return response()->json(['message' => 'The vehicle is created with id'], 201);
    }

    public function show($id, $vehicleId)
    {
        $maker = Maker::find($id);

        //if maker id is not found, error is displayed
        if(!$maker){
            return response()->json(['message' => 'This maker does not exist', 'code' => 404], 404);
        }

        $vehicle = $maker->vehicles->find($vehicleId);

        if(!$vehicle){
            return response()->json(['message' => 'This vehicle does not exist for this maker', 'code' => 404], 404);
        }

        return response()->json(['data' => $maker->vehicles->find($vehicleId)], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateVehicleRequest $request, $makerId, $vehicleId)
    {
        $maker = Maker::find($makerId);

        //if maker id is not found, error is displayed
        if (!$maker) {
            return response()->json(['message' => 'This maker does not exist', 'code' => 404], 404);
        }

        $vehicle = $maker->vehicles->find($vehicleId);

        if (!$vehicle) {
            return response()->json(['message' => 'This vehicle does not exist for this maker', 'code' => 404], 404);
        }

        $color = $request->get('color');
        $power = $request->get('power');
        $capacity = $request->get('capacity');
        $speed = $request->get('speed');

        $vehicle->color = $color;
        $vehicle->power = $power;
        $vehicle->capacity = $capacity;
        $vehicle->speed = $speed;

        $vehicle->save();

        return response()->json(['message' => 'The maker has been updated'], 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($makerId, $vehicleId)
    {
        $maker = Maker::find($makerId);

        //if maker id is not found, error is displayed
        if (!$maker) {
            return response()->json(['message' => 'This maker does not exist', 'code' => 404], 404);
        }

        $vehicle = $maker->vehicles->find($vehicleId);

        if (!$vehicle) {
            return response()->json(['message' => 'This vehicle does not exist for this maker', 'code' => 404], 404);
        }

        $vehicle->delete();

        return response()->json(['message' => 'The vehicle has been deleted'], 200);
    }
}
