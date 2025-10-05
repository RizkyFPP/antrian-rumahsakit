<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'totalPasien' => 1250,
            'poliAktif' => 15,
            'dokter' => 30
        ];

        return view('home', compact('data'));
    }
}
