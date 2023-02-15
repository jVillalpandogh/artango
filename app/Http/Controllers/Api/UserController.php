<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
class UserController extends Controller
{
    public function register(Request $request){
        if ($request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ])){
            $user = User::create([
                'name' => $request->name,  
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user->save();

            return response(Response::HTTP_CREATED)->json([
            'status' =>'success',
            'message' =>'Registration successful']);
        }
        else{
            return response(['message'=>'error Creating user'],Response::HTTP_BAD_REQUEST);
        }
    }  
    public function login(Request $request){
        $credentials = $request->validate([
            "email"=>"required|email",
            "password"=>"required"
        ]);
        
        if (Auth::attempt($credentials)){ 
            $user = Auth::user();    
            $token = $user->createToken("auth_token")->plainTextToken;
            $cookie = cookie('cookie_token',$token,60*24);   
            return response(['access_token' => $token],Response::HTTP_OK)->withoutCookie($cookie);
        }else {
            return response(['message'=>'error with credentials'],Response::HTTP_UNAUTHORIZED);
        }
    }  
    public function userProfile(){
        //if ((Auth::user()->tokens())!=null)
        //if (auth()->check())
        if (Auth::check())
            return response()->json([
                'status' =>'success',
                'message' =>'User profile informartion',
                'data' => auth()->user()
            ],Response::HTTP_OK);
        else
        return response(['message'=>'error'],Response::HTTP_BAD_REQUEST); //->json(['message'=>'User must be registered    ','status'=>Response::HTTP_UNAUTHORIZED]);
    }  
    public function logout(){
        
        Auth::user()->tokens->each(function($token, $key) {
             $token->delete();
        });
        return response([
            'status' =>'success',
            'message' =>'User is out'],Response::HTTP_OK);
            //if (false ){ //Auth::check()
       /*} else{
            Auth::user()->tokens->
            return response(['message'=>'User is out'],Response::HTTP_BAD_REQUEST);
        }*/
        
    }
    public function userslist(){
        return response(User::all());
    }   
}
