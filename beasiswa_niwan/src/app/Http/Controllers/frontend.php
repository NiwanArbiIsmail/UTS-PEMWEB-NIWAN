<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use Illuminate\Http\Request;

class frontend extends Controller
{
    public function home ()
    {
        $beasiswas = beasiswa::get();
            return view('frontend.home.index', compact('beasiswas'));
    }

    public function beasiswa ()
    {
        $beasiswas = beasiswa::get();
            return view('frontend.home.beasiswa', compact('beasiswas'));
    }

    public function about ()
    {
        $beasiswas = beasiswa::get();
            return view('frontend.home.about', compact('beasiswas'));
    }
}
