<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Favoritos;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ServerController extends Controller
{

    public function signup(Request $request) //Hace la validación de back
    {
        //dd($request);
        $request->validate([
            "username" => "string|required|min:3|max:10|regex:/^[a-zA-Z\d]{3,10}$/",
            "email" => "string|required|regex:/^[a-zA-Z]+[a-zA-Z\d]*@[a-zA-Z]+\.[a-z]+$/",
            "password" => "string|required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).*$/",
            "password2" => "string|required|same:password"
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

        // Permite debugear dd("Paso creacion");
        if (count($error) != 0) {
            session_start();
            $_SESSION["forminfo"] = [
                "username" => $request->username,
                "email" => $request->email,
                "error" => $error
            ];
            return redirect()->route("signup");
        } else {
            $user = User::create([
                "name" => $request->username,
                "email" => $request->email,
                "password" => password_hash($request->password, PASSWORD_DEFAULT),
                "user_type" => 1
            ]);

            //copy paste pfp
            $origen = public_path('ProfilePictures/defaultPFP.png');
            $destino = public_path("ProfilePictures/" . $user->name . ".png");
            copy($origen, $destino);

            return redirect()->route("login");
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            "username" => "string|required",
            "password" => "string|required"
        ]);
        try {
            $user = User::where("name", $request->username)->firstOrFail();
            if (password_verify($request->password, $user->password)) {
                session_start();
                $_SESSION["username"] = $request->username;
                return redirect()->route("home");
            } else {
                session_start();
                $_SESSION["error"] = "El usuario o contraseña es incorrecto";
                return redirect()->route("login");
            }
        } catch (ModelNotFoundException) {
            session_start();
            $_SESSION["error"] = "El usuario o contraseña es incorrecto";
            return redirect()->route("login");
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        return redirect()->route("login");
    }

    public function addFavoriteBook(Request $request) {

        session_start();

        if (!isset($_SESSION["username"])) {
            return redirect()->route('login');
        }

        $user = User::where("name", $_SESSION["username"])->firstOrFail();

        Favoritos::create([
            "user_id" => $user->id,
            "olid" => $request->olid
        ]);

        return redirect()->route('book', ["olid" => $request->olid]);
    }

    public function removeFavoriteBook(Request $request) {
        session_start();

        if (!isset($_SESSION["username"])) {
            return redirect()->route('login');
        }

        $user = User::where("name", $_SESSION["username"])->firstOrFail();

        Favoritos::where("user_id", $user->id)->where("olid", $request->olid)->delete();

        return redirect()->route('book', ["olid" => $request->olid]);
    }
}
