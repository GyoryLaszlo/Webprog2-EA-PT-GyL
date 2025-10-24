<?php

namespace App\Http\Controllers;

use App\Models\Processzor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class ProcesszorController extends Controller
{
    public function index()
    {
        $proc = Processzor::orderBy('gyarto')->orderBy('tipus')->paginate(10);
        // >>> MINDIG a crud/index.blade.php-t rendereljük
        return view('crud.index', ['proc' => $proc, 'procMode' => 'list']);
    }

    public function create()
    {
        return view('crud.index', ['procMode' => 'create']);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Processzor::create($data);
        return redirect()->route('crud.processzorok.index')->with('ok','Processzor rögzítve.');
    }

    public function edit(Processzor $processzor)
    {
        return view('crud.index', ['procMode' => 'edit', 'processzor' => $processzor]);
    }

    public function update(Request $request, Processzor $processzor)
    {
        $data = $this->validated($request, $processzor->id);
        $processzor->update($data);
        return redirect()->route('crud.processzorok.index')->with('ok','Processzor módosítva.');
    }

    public function destroy(Processzor $processzor)
    {
        try {
            $processzor->delete();
            return redirect()->route('crud.processzorok.index')->with('ok','Processzor törölve.');
        } catch (QueryException $e) {
            return back()->with('err','Nem törölhető: van hozzá kapcsolt gép.');
        }
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        $uniqueTipus = Rule::unique('processzor','tipus')
            ->where(fn($q)=>$q->where('gyarto',$request->input('gyarto')));
        if ($ignoreId) $uniqueTipus->ignore($ignoreId);

        return $request->validate([
            'gyarto' => ['required','string','max:100'],
            'tipus'  => ['required','string','max:150',$uniqueTipus],
        ], [], ['gyarto'=>'Gyártó','tipus'=>'Típus']);
    }
}
