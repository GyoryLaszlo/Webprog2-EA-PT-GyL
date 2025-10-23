<?php

namespace App\Http\Controllers;

use App\Models\Gep;

class AdatbazisController extends Controller
{
    public function index()
    {
        $gepek = Gep::with(['processzor','oprendszer'])
            ->orderBy('ar','desc')
            ->paginate(20);

        return view('adatbazis', compact('gepek'));
    }
}
