<?php

namespace App\Http\Controllers;

use App\Models\LetterType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LetterTypeController extends Controller
{
    public function index()
    {
        return \view('admin.lettertypes.index', [
            'lettertypes' => LetterType::paginate(),
        ]);
    }

    public function create()
    {
        return \view('admin.lettertypes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lettertype_name' => 'required|string|min:1|max:255',
            'lettertype_code' => 'nullable|string|min:1|max:255',
        ]);

        LetterType::create([
            'name' => $request->lettertype_name,
            'code' => $request->lettertype_code ?? Str::of($request->lettertype_name)->substr(0,1),
        ]);

        return redirect()->route('lettertypes.index');
    }

    public function edit(Request $request, $letterType)
    {
        return \view('admin.lettertypes.edit', [
            'lettertype' => LetterType::find($letterType)
        ]);
    }

    public function update(Request $request, $letterType)
    {
        $request->validate([
            'lettertype_name' => 'required|string|min:1|max:255',
            'lettertype_code' => 'nullable|string|min:1|max:255',
        ]);

        LetterType::find($letterType)->update([
            'name' => $request->lettertype_name,
            'code' => $request->lettertype_code ?? Str::of($request->lettertype_name)->substr(0,1),
        ]);

        return redirect()->route('lettertypes.index');
    }

    public function delete(Request $request, $letterType)
    {
        return \view('admin.lettertypes.delete',[
            'lettertype' => LetterType::find($letterType)
        ]);
    }

    public function destroy(Request $request, $letterType)
    {
        LetterType::find($letterType)->delete();

        return redirect()->route('lettertypes.index');
    }
}
