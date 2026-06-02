<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ToolController extends Controller
{
    /**
     * Muestra la herramienta de generación de códigos QR.
     */
    public function qr(): View
    {
        return view('tools.qr');
    }
}
