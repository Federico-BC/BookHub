<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Favoritos;
use App\Models\Leido;
use App\Models\PorLeer;
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
        
        $request->validate([
            "olid" => "string|required",
            "listCode" => "integer|required"
        ]);

        $user = User::where("name", $_SESSION["username"])->firstOrFail();

        switch ($request->listCode) {
            case '1': {
                
                Favoritos::create([
                    "user_id" => $user->id,
                    "olid" => $request->olid
                ]);

                break;
            }
            case '2': {
                Leido::create([
                    "user_id" => $user->id,
                    "olid" => $request->olid
                ]);
                
                break;
            }
            case '3': {
                PorLeer::create([
                    "user_id" => $user->id,
                    "olid" => $request->olid
                ]);

                break;
            }
        }

        return redirect()->route('book', ["olid" => $request->olid]);
    }

    public function removeFavoriteBook(Request $request) {
        session_start();

        if (!isset($_SESSION["username"])) {
            return redirect()->route('login');
        }

        $request->validate([
            "olid" => "string|required",
            "listCode" => "integer|required"
        ]);

        $user = User::where("name", $_SESSION["username"])->firstOrFail();

        switch ($request->listCode) {
            case '1': {

                Favoritos::where("user_id", $user->id)->where("olid", $request->olid)->delete();

                break;
            }     
            case '2': {

                Leido::where("user_id", $user->id)->where("olid", $request->olid)->delete();

                break;
            }
            case '3': {

                PorLeer::where("user_id", $user->id)->where("olid", $request->olid)->delete();

                break;
            }
        }

        return redirect()->route('book', ["olid" => $request->olid]);
    }

    public function saveProfileChanges(Request $request) {

        session_start();

        if (isset($request->newUsername)) {
            $request->validate([
                "newUsername" => "string|min:3|max:10|regex:/^[a-zA-Z\d]{3,10}$/"
            ]);
        }

        if (isset($request->newEmail)) {
            $request->validate([
                "newEmail" => "string|regex:/^[a-zA-Z]+[a-zA-Z\d]*@[a-zA-Z]+\.[a-z]+$/"
            ]);
        }

        if (isset($request->newPfp)) {
            $request->validate([
                "newPfp" => "image|max:5120"
            ]);
        }

        $photo = $request->file("newPfp");

        $newUsername = (isset($request->newUsername) && trim($request->newUsername) != "") ? $request->newUsername : $_SESSION["username"];

        $oldUsername = $_SESSION['username'];

        $photoChanged = false;

        if (isset($photo)) {

            $oldPhotoPath = public_path("ProfilePictures/$oldUsername.png");

            unlink($oldPhotoPath);

            $photo->move(public_path("ProfilePictures"), "$newUsername.png");

            $photoChanged = true;
        }

        $bdUser = User::where("name", $_SESSION["username"])->first();

        if (isset($request->newUsername) && trim($request->newUsername) != "" && trim($request->newUsername) != $bdUser->name) {
            $bdUser->name = $request->newUsername;

            if(!$photoChanged) {

                $oldPhotoPath = public_path("ProfilePictures/$oldUsername.png");
                $newPhotoPath = public_path("ProfilePictures/$newUsername.png");

                rename($oldPhotoPath, $newPhotoPath);
            }
        }

        if (isset($request->newEmail) && trim($request->newEmail) != "" && trim($request->newEmail) != $bdUser->email) {
            $bdUser->email = $request->newEmail;
        }

        $bdUser->save();

        $_SESSION["username"] = $bdUser->name;

        return redirect()->route('accountSettings');
    }
}
