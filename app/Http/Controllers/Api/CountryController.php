<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use Symfony\Component\HttpFoundation\Response;

class CountryController extends Controller
{
    public function store(Request $request){
        if ($request->validate([
            'name' => 'required',
            'code' => 'required|unique:countries'
        ])){
            $country = new Country();
            $country->name = $request->name;
            $country->code = $request->code;
            $country->save();
            return response(['message'=>'Country has been created','object'=>$country],Response::HTTP_CREATED);
        }

    }
}