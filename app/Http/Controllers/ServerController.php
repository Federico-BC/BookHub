<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ServerController extends Controller
{

    public function signup(Request $request)
    {
        //dd($request);
        $request->validate([
            "username"=>"string|required|min:3|max:10|regex:/^[a-zA-Z\d]{3,10}$/",
            "email"=>"string|required|regex:/^[a-zA-Z]+[a-zA-Z\d]*@[a-zA-Z]+\.[a-z]+$/",
            "password"=>"string|required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).*$/",
            "password2"=>"string|required|same:password"
        ]);

        $user = User::create([
            "name"=> $request->username,
            "email"=> $request->email,
            "password"=> password_hash($request->password, PASSWORD_DEFAULT),
            "user_type"=> 1
        ]);
       // Permite debugear dd("Paso creacion");
        return redirect()->route("login");
    }

    public function checksignup(Request $request){
        $request->validate([
            "username"=>"string|required|min:3|max:10|regex:/^[a-zA-Z\d]{3,10}$/",
            "email"=>"string|required|regex:/^[a-zA-Z]+[a-zA-Z\d]*@[a-zA-Z]+\.[a-z]+$/"
        ]);
        $error = [];
        try {
            if (User::where("name", $request->username)->firstOrFail()) {
                $error[] = "username";
            }
        } catch (ModelNotFoundException) {
        }

        try {
            if (User::where("email", $request->email)->firstOrFail()) {
                $error[] = "email";
            }
        } catch (ModelNotFoundException) {  
        }
        if (count($error) != 0) {
            return response()->json(["code"=> 1, "message" => "Hay errores en algun campo", "errors" => $error]);
        }else {
            return response()->json(["code"=> 0, "message" => "No hay errores"]);
        }
    }
}
