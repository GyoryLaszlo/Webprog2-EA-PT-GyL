<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Message;


class ContactController extends Controller
{
     public function create() {
        return view('contact');
    }

    public function store(StoreContactRequest $request) {
        $data = $request->validated();
        $data['ip'] = $request->ip();
        $data['user_agent'] = substr((string) $request->userAgent(), 0, 255);

        Message::create($data);

        return back()->with('success', 'Köszönjük. Üzenetedet rögzítettük.');
    }
}