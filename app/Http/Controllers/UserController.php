<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        return \view('admin.users.index', [
            'users' => User::paginate(),
        ]);
    }

    public function create()
    {
        return \view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:255',
            'family' => 'required|string|min:1|max:255',
        ]);

        User::create([
            'name' => $request->name,
            'family' => $request->family,
        ]);

        return redirect()->route('users.index');
    }

    public function edit(Request $request, $user)
    {
        return \view('admin.users.edit', [
            'user' => User::find($user)
        ]);
    }

    public function update(Request $request, $user)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:255',
            'family' => 'required|string|min:1|max:255',
        ]);

        User::find($user)->update([
            'name' => $request->name,
            'family' => $request->family,
        ]);

        return redirect()->route('users.index');
    }

    public function delete(Request $request, $user)
    {
        return \view('admin.users.delete',[
            'user' => User::find($user)
        ]);
    }

    public function destroy(Request $request, $user)
    {
        User::find($user)->delete();

        return redirect()->route('users.index');
    }
}
