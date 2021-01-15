<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\LetterType;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class LetterController extends Controller
{
    public function index()
    {
        return \view('admin.letters.index', [
            'letters' => Letter::with('lettertype', 'project', 'user')->paginate(),
        ]);
    }

    public function create()
    {
        return \view('admin.letters.create', [
            'lettertypes' => LetterType::pluck('name', 'id')->toArray(),
            'projects' => Project::pluck('name', 'id')->toArray(),
            'users' => User::pluck('name', 'id')->toArray(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'lettertype' => 'required|int|exists:lettertypes,id',
            'project' => 'required|int|exists:projects,id',
            'date' => 'required|date',
            'title' => 'required|string|min:1|max:255',
            'user' => 'required|int|exists:users,id',
        ]);

        Letter::create([
            'id' => Uuid::uuid4()->toString(),
            'lettertype_id' => $request->lettertype,
            'project_id' => $request->project,
            'date' => $request->date,
            'title' => $request->title,
            'user_id' => $request->user,
        ]);

        return redirect()->route('letters.index');
    }

    public function edit(Request $request, string $letter)
    {
        return \view('admin.letters.edit', [
            'letter' => Letter::find($letter),
            'lettertypes' => LetterType::pluck('name', 'id')->toArray(),
            'projects' => Project::pluck('name', 'id')->toArray(),
            'users' => User::pluck('name', 'id')->toArray(),
        ]);
    }

    public function update(Request $request, string $letter)
    {
        $request->validate([
            'lettertype' => 'required|int|exists:lettertypes,id',
            'project' => 'required|int|exists:projects,id',
            'date' => 'required|date',
            'title' => 'required|string|min:1|max:255',
            'user' => 'required|int|exists:users,id',
        ]);

        Letter::find($letter)->update([
            'lettertype_id' => $request->lettertype,
            'project_id' => $request->project,
            'date' => $request->date,
            'title' => $request->title,
            'user_id' => $request->user,
        ]);

        return redirect()->route('letters.index');
    }

    public function delete(Request $request, $letter)
    {
        return \view('admin.letters.delete',[
            'letter' => Letter::find($letter)
        ]);
    }

    public function destroy(Request $request, $letter)
    {
        Letter::find($letter)->delete();

        return redirect()->route('letters.index');
    }
}
