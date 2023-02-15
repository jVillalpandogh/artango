<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use Symfony\Component\HttpFoundation\Response;

class CityController extends Controller
{
    public function store(Request $request){
        if ($request->validate([
            'name' => 'required',
            'stateId' => 'required'
        ])){
            $city = new City();
            $city->name = $request->name;
            $city->stateId= $request->stateId;
            $city->save();
            return response(['message'=>'State has been created','object'=>$city],Response::HTTP_CREATED);
        }

    }
}
