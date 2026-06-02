<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Muestra la página de inicio de la plataforma PGIQR.
     */
    public function index()
    {
        return view('home.index');
    }
}
