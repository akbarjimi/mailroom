<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        return \view('admin.projects.index', [
            'projects' => Project::paginate(),
        ]);
    }

    public function create()
    {
        return \view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:255',
            'code' => 'required|string|min:1|max:255',
        ]);

        Project::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->route('projects.index');
    }

    public function edit(Request $request, $project)
    {
        return \view('admin.projects.edit', [
            'project' => Project::find($project)
        ]);
    }

    public function update(Request $request, $project)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:255',
            'code' => 'required|string|min:1|max:255',
        ]);

        Project::find($project)->update([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->route('projects.index');
    }

    public function delete(Request $request, $project)
    {
        return \view('admin.projects.delete',[
            'project' => Project::find($project)
        ]);
    }

    public function destroy(Request $request, $project)
    {
        Project::find($project)->delete();

        return redirect()->route('projects.index');
    }
}
