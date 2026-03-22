<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MaterialController extends Controller
{
    /**
     * Display the initial view with 2 buttons/links
     */
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Material - Home';
        return view('material.index')->with('viewData', $viewData);
    }

    /**
     * Show the form to create a new material
     */
    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = 'Create Material';
        return view('material.create')->with('viewData', $viewData);
    }

    /**
     * Store a newly created material in database
     */
    public function save(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:materials,name',
            'type' => 'required|string|max:100',
            'description' => 'required|string',
            'color' => 'required|string|max:50',
        ]);

        Material::create($validated);

        return redirect()->route('material.list')
                   ->with('success', 'Element created successfully');
    }

    /**
     * Display a list of all materials with id and name
     */
    public function list(): View
    {
        $viewData = [];
        $viewData['title'] = 'Materials - List';
        $viewData['materials'] = Material::all();
        return view('material.list')->with('viewData', $viewData);
    }

    /**
     * Display the specified material details
     */
    public function show(string $id): View
    {
        $viewData = [];
        $material = Material::findOrFail($id);
        $viewData['title'] = $material->getName() . ' - Material';
        $viewData['material'] = $material;
        return view('material.show')->with('viewData', $viewData);
    }

    /**
     * Delete the specified material and redirect to list
     */
    public function destroy(string $id): RedirectResponse
    {
        Material::findOrFail($id)->delete();

        return redirect()->route('material.list')
                   ->with('success', 'Material deleted successfully');
    }
}