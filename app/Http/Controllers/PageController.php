<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function login()
    {
        session_start();
        $error = null;
        if (isset($_SESSION["error"])) {
            $error=$_SESSION["error"];
            $_SESSION["error"] = null;
        }
        return view('login', compact("error"));
    }
    public function signup()
    {
        session_start();
        $forminfo = null;
        if (isset($_SESSION["forminfo"])) {
            $forminfo=$_SESSION["forminfo"];
            $_SESSION["forminfo"] = null; // Para borrar los datos
        }
        return view('signup', compact("forminfo"));
    }
}
