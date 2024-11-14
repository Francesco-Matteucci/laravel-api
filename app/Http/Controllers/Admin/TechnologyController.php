<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('admin.projects.index')->with('error', 'Accesso negato, non possiedi i privilegi adatti per questa funzione');
        }

        $technologies = Technology::all();
    return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('admin.projects.index')->with('error', 'Accesso negato, non possiedi i privilegi adatti per questa funzione');
        }

        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('admin.projects.index')->with('error', 'Accesso negato, non possiedi i privilegi adatti per questa funzione');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Technology::create($validatedData);

        return redirect()->route('admin.technologies.index')->with('success', 'Tecnologia creata con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('admin.projects.index')->with('error', 'Accesso negato, non possiedi i privilegi adatti per questa funzione');
        }

        $technology = Technology::findOrFail($id);
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('admin.projects.index')->with('error', 'Accesso negato, non possiedi i privilegi adatti per questa funzione');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $technology = Technology::findOrFail($id);
        $technology->update($request->only('name'));

        return redirect()->route('admin.technologies.index')->with('success', 'Technology updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('admin.projects.index')->with('error', 'Accesso negato, non possiedi i privilegi adatti per questa funzione');
        }

        $technology->delete();
    return redirect()->route('admin.technologies.index')->with('success', 'Tecnologia eliminata con successo!');

    }
}