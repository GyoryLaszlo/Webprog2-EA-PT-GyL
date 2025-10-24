<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    public function index()
    {
        $users = User::select('id','name','email','is_admin')->orderBy('id')->paginate(20);
        return view('admin', compact('users'));
    }

    public function update(Request $request, User $user)
    {
        $makeAdmin = $request->boolean('is_admin');

        if (!$makeAdmin && $user->is_admin && User::where('is_admin', true)->count() <= 1) {
            return back()->with('error', 'Az utolsó admin jogát nem veheted el.');
        }
        if ($request->user()->id === $user->id && !$makeAdmin) {
            return back()->with('error', 'Magadról nem veheted le az admin jogot.');
        }

        $user->update(['is_admin' => $makeAdmin]);
        return back()->with('status', 'Felhasználó frissítve.');
    }
}
