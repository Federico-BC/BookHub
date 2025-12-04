<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Favoritos;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        
        if (!isset($_SESSION["username"])) {
            return redirect()->route('login');
        }

        $username = $_SESSION["username"];

        return view('home', compact("username"));
    }

    public function search(Request $request) {

        session_start();

        if (!isset($_SESSION["username"])) {
            return redirect()->route('login');
        }

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

    public function book($olid) {
        
    session_start();

    if (!isset($_SESSION["username"])) {
        return redirect()->route('login');
    }

    $username = $_SESSION["username"];


    $petitionUrl = "https://openlibrary.org/books/$olid.json";

    $curl = curl_init($petitionUrl);

    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 10
    ]);

    $response = curl_exec($curl);

    $data = json_decode($response, true);

    $authorRoute = null;
    $authorName = "Desconocido";
    $pages = null;
    $publisher = null;
    $description = null;

    if (is_null($data) || isset($data['error'])) {
         $title = "Libro No Encontrado";
    } else {
        $title = $data["title"] ?? "Título Desconocido";

        if (isset($data["authors"]) && is_array($data["authors"]) && isset($data["authors"][0]) && isset($data["authors"][0]["key"])) {
            $authorRoute = $data["authors"][0]["key"];
        }
        
        if ($authorRoute) {
            $authorPetitionUrl = "https://openlibrary.org" . $authorRoute . ".json";
            
            $authorCurl = curl_init($authorPetitionUrl);
            curl_setopt_array($authorCurl, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 5
            ]);
            
            $authorResponse = curl_exec($authorCurl);
            $authorData = json_decode($authorResponse, true);
            
            if (isset($authorData["name"])) {
                $authorName = $authorData["name"];
            }
        }
    }


    if (isset($data["number_of_pages"])) {
        $pages = $data["number_of_pages"];
    }

    if (isset($data["publishers"])) {
        $publisher = $data["publishers"];
    }
    
    $isbn = [];
    if(isset($data["isbn_10"]) && isset($data["isbn_10"][0])) {
        $isbn[] = $data["isbn_10"][0];
    }

    if(isset($data["isbn_13"]) && isset($data["isbn_13"][0])) {
        $isbn[] = $data["isbn_13"][0];
    }
    
    if (isset($data["description"]) && is_array($data["description"]) && isset($data["description"]["value"])){
        $description = $data["description"]["value"];
    } else if (isset($data["description"]) && is_string($data["description"])) {
         $description = $data["description"];
    }

    $user = User::where("name", $username)->firstOrFail();
    
    try {
        Favoritos::where("user_id", $user->id)->where("olid", $olid)->firstOrFail();
        $fav = true;
    } catch (ModelNotFoundException $e) {
        $fav = false;
    }

    return view('book', compact("username", "title", "pages", "publisher", "isbn", "authorRoute", "fav", "description", "olid", "authorName"));
}

    public function profile($profileUsername) {

        session_start();

        if (!isset($_SESSION["username"])) {
            return redirect()->route('login');
        }

        $username = $_SESSION["username"];

        try{
            $user = User::where("name", $profileUsername)->firstOrFail();
            $exists = true;
            $email = $user->email;
    
            $rawFavs = Favoritos::where("user_id", $user->id)->get(["olid"]);

            $favs = [];

            foreach ($rawFavs as $rawFav) {
                $favs[] = $rawFav->olid;
            }

            return view('profile', compact("username", "exists", "profileUsername", "email", "favs"));

        } catch (ModelNotFoundException) {
            $exists = false;
            return view('profile', compact("username", "exists"));
        }
    }
}
