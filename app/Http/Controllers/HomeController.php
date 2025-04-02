<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('home');
    }

    public function debug() {
        for ($i = 8; $i <= 36; $i++) {

            echo '.f-' . $i . '{font-size: ' . $i . 'px !important;} <br>';
        }
    }
}
