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

    public function home()
    {
        session_start();
        $username = $_SESSION["username"];
        return view('home', compact("username"));
    }

    public function search(Request $request) {

        session_start();

        $username = $_SESSION["username"];

        $searchTerm = $request->term;

        $petitionQueryUrl = "https://openlibrary.org/search.json?limit=10&q=";

        $parsedUrl= urlencode($searchTerm);

        $finalUrl = $petitionQueryUrl . $parsedUrl;

        $curl = curl_init($finalUrl);

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10
        ]);

        $response = curl_exec($curl);

        $data = json_decode($response, true);

        $booksFound = isset($data["numFound"]) && $data["numFound"] > 0;

        $booksOlids = [];

        if (isset($data["docs"])) {
            foreach ($data["docs"] as $bookInfo) {
                if (isset($bookInfo["cover_edition_key"])) {
                    $booksOlids[] = $bookInfo["cover_edition_key"];
                }
            }
        }
        
        return view('search', compact("username", "searchTerm", "booksFound", "booksOlids"));
    }
}
