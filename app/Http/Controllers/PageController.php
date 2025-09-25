<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function signup()
    {
        return view('signup');
    }
}
