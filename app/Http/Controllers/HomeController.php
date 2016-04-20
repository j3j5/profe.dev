<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Asset;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Asset::addStyle(file_get_contents(public_path('css/home.css')));
        Asset::add("//fonts.googleapis.com/css?family=Gloria+Hallelujah");

        return view('site.home');
    }
}
