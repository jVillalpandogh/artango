<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use Symfony\Component\HttpFoundation\Response;

class StateController extends Controller
{
    public function store(Request $request){
        if ($request->validate([
            'name' => 'required',
            'countryId' => 'required'
        ])){
            $state = new State();
            $state->name = $request->name;
            $state->countryID = $request->countryId;
            $state->save();
            return response(['message'=>'State has been created','object'=>$state],Response::HTTP_CREATED);
        }

    }
}
