<?php

// app/Http/Controllers/MessageController.php
namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $messages = Message::where('id', $request->user()->id)
            ->latest()               // ORDER BY created_at DESC
            ->paginate(15)
            ->withQueryString();

        return view('messages.index', compact('messages'));
    }
}
