<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Vehicle;
use App\Maker;
use App\Http\Requests;
use App\Http\Requests\CreateMakerRequest;
use App\Http\Controllers\Controller;



class MakerController extends Controller
{
    public function __construct(){
        $this->middleware('auth.basis.once', ['except' => ['index', 'show']]);
    }

    /**
     * Display all car maker's data
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $makers = Maker::all();
        return response()->json(['data' => $makers], 200);
    }


    /**
     * Storing car maker's today
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMakerRequest $request)
    {
        $values = $request->only('name', 'phone');

        Maker::create($values);

        return response()->json(['message' => 'Maker correctly added'], 201);


    }

    /**
     * Display specific maker's data.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $maker = Maker::find($id);

        //if maker id is not found, error is displayed
        if(!$maker){
            return response()->json(['message' => 'This maker does not exist', 'code' => 404], 404);
        }

        return response()->json(['data' => $maker], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateMakerRequest $request, $id)
    {
        $maker = Maker::find($id);

        //if maker id is not found, error is displayed
        if(!$maker){
            return response()->json(['message' => 'This maker does not exist', 'code' => 404], 404);
        }

        $name = $request->get('name');
        $phone = $request->get('phone');

        $maker->name = $name;
        $maker->phone = $phone;

        $maker->save();

        return response()->json(['message' => 'The maker has been updated'], 200);




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $maker = Maker::find($id);

        //if maker id is not found, error is displayed
        $maker->makerExistCheck($maker);

        $vehicles = $maker->vehicles;

        if(sizeof($vehicles) > 0){
            return response()->json([
                'message' => 'This maker has associated vehicles. Please delete them first.',
                'code' => 404], 404);
        }

        $maker->delete();

        return response()->json(['message' => 'The maker has been deleted'], 200);
    }
}
