<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Technology;
use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $projects = Project::all();
            return view('admin.projects.index', compact('projects'));
        }

        return redirect('/')->with('error', 'Accesso negato, non possiedi i privilegi adatti per questa funzione');
    }

    public function create()
{
    if (!Auth::user()->is_admin) {
        return redirect()->route('admin.projects.index')->with('error', 'Accesso negato, non possiedi i privilegi adatti per questa funzione');
    }

    $types = Type::all();
    $technologies = Technology::all();

    return view('admin.projects.create', compact('types', 'technologies'));
}



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('admin.projects.index')->with('error', 'Accesso negato, non possiedi i privilegi adatti per questa funzione');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'type_id' => 'required|exists:types,id',
            'technologies' => 'array|exists:technologies,id',
        ]);

        $project = Project::create($validatedData);

        if (isset($validatedData['technologies'])) {
            $project->technologies()->sync($validatedData['technologies']);
        } else {
            $project->technologies()->sync([]);
        }


        return redirect()->route('admin.projects.index')->with('success', 'Progetto creato con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    $project = Project::with('type')->findOrFail($id);

    return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        $types = Type::all();
        $technologies = Technology::all();

    return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

    if (!Auth::user()->is_admin && !Auth::user()->is_moderator) {
        return redirect()->route('admin.projects.index')->with('error', 'Accesso negato, non possiedi i privilegi adatti per questa funzione');
    }

    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'url' => 'nullable|url',
        'type_id' => 'required|exists:types,id',
        'technologies' => 'array|exists:technologies,id',
    ]);

    $project->update($validatedData);

    if (isset($validatedData['technologies'])) {
        $project->technologies()->sync($validatedData['technologies']);
    } else {
        $project->technologies()->sync([]);
    }

    return redirect()->route('admin.projects.index')->with('success', 'Progetto aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);

        if (!Auth::user()->is_admin) {
            return redirect()->route('admin.projects.index')->with('error', 'Accesso negato, non possiedi i privilegi adatti per questa funzione');
        }

        $project->technologies()->detach();

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Progetto eliminato con successo!');
    }
}