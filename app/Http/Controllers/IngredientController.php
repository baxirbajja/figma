<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IngredientController extends Controller
{
    /**
     * Display a listing of the ingredients.
     */
    public function index(Request $request)
    {
        $query = Ingredient::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('reference', 'like', "%{$search}%")
                  ->orWhere('name_fr', 'like', "%{$search}%")
                  ->orWhere('name_en', 'like', "%{$search}%")
                  ->orWhere('name_it', 'like', "%{$search}%");
            });
        }

        $ingredients = $query->orderBy('reference')->paginate(10);
        return view('ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new ingredient.
     */
    public function create()
    {
        return view('ingredients.create');
    }

    /**
     * Store a newly created ingredient in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_fr' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_it' => 'required|string|max:255',
        ]);

        // Generate a unique reference based on the French name
        $baseReference = Str::upper(Str::substr(Str::slug($validated['name_fr']), 0, 5));
        $reference = $baseReference;
        $counter = 1;

        // Ensure the reference is unique
        while (Ingredient::where('reference', $reference)->exists()) {
            $reference = $baseReference . str_pad($counter, 2, '0', STR_PAD_LEFT);
            $counter++;
        }

        $validated['reference'] = $reference;
        $validated['is_active'] = true;

        Ingredient::create($validated);

        return redirect()->route('ingredients.index')
            ->with('success', 'Ingredient created successfully.');
    }

    /**
     * Display the specified ingredient.
     */
    public function show(Ingredient $ingredient)
    {
        $ingredient->load('products');
        return view('ingredients.show', compact('ingredient'));
    }

    /**
     * Show the form for editing the specified ingredient.
     */
    public function edit(Ingredient $ingredient)
    {
        return view('ingredients.edit', compact('ingredient'));
    }

    /**
     * Update the specified ingredient in storage.
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $validated = $request->validate([
            'name_fr' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_it' => 'required|string|max:255',
            'is_active' => 'boolean'
        ]);

        $ingredient->update($validated);

        return redirect()->route('ingredients.index')
            ->with('success', 'Ingredient updated successfully.');
    }

    /**
     * Remove the specified ingredient from storage.
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return redirect()->route('ingredients.index')
            ->with('success', 'Ingredient deleted successfully.');
    }
}
