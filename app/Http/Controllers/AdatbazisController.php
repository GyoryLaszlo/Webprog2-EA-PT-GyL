<?php

namespace App\Http\Controllers;

use App\Models\Gep;
use Illuminate\Http\Request;

class AdatbazisController extends Controller
{
    public function index(Request $request)
    {
        // Alap lekérdezés
        $query = Gep::with(['processzor', 'oprendszer']);

        // Szűrés processzor gyártó szerint (?cpu=Intel)
        if ($request->filled('cpu')) {
            $query->whereHas('processzor', function ($q) use ($request) {
                $q->where('gyarto', 'like', '%' . $request->cpu . '%');
            });
        }

        // Szűrés operációs rendszer szerint (?os=Windows)
        if ($request->filled('os')) {
            $query->whereHas('oprendszer', function ($q) use ($request) {
                $q->where('nev', 'like', '%' . $request->os . '%');
            });
        }

        // Szűrés ár szerint (?maxar=300000)
        if ($request->filled('maxar')) {
            $query->where('ar', '<=', (int)$request->maxar);
        }
        
        //rendez,lapozás
        $gepek = Gep::with(['processzor','oprendszer'])
            ->orderBy('ar','desc')
            ->paginate(15);

        return view('adatbazis', compact('gepek'));
    }
}
