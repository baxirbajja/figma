<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(Request $request)
    {
        $query = Product::with(['ingredients', 'category']);
        
        // Filter by category if provided
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }
        
        // Search functionality with language support
        if ($request->has('search')) {
            $search = $request->search;
            $language = $request->get('language', 'fr');
            $nameField = "name_$language";
            
            $query->where(function($q) use ($search, $nameField) {
                $q->where($nameField, 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        $products = $query->paginate(10);
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $ingredients = Ingredient::active()->get();
        $categories = Category::all();
        return view('products.create', compact('ingredients', 'categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        Log::info('Product creation attempt', $request->all());
    
    try {
        $validated = $request->validate([
            'name_fr' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_it' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'delivery_price' => 'required|numeric|min:0',
            'category_ids' => 'required|array', // Changed from category_id to category_ids
            'category_ids.*' => 'exists:categories,id', // Validate each category ID
            'sku' => 'required|string|unique:products,sku',
            'stock' => 'required|integer|min:0',
            'ingredients' => 'array',
            'ingredients.*.id' => 'nullable|exists:ingredients,id',
            'ingredients.*.quantity' => 'nullable|numeric|min:0'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('products', $filename, 'public');
            $validated['image_path'] = $path;
        }

        $product = Product::create([
            'name_fr' => $validated['name_fr'],
            'name_en' => $validated['name_en'],
            'name_it' => $validated['name_it'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'delivery_price' => $validated['delivery_price'],
            'category_id' => $validated['category_ids'][0], // Take the first category
            'sku' => $validated['sku'],
            'stock' => $validated['stock']
        ]);
        // Attach ingredients
        foreach ($validated['ingredients'] as $id => $data) {
            if (isset($data['id']) && isset($data['quantity']) && $data['quantity'] !== null) {
                $product->ingredients()->attach($data['id'], ['quantity' => $data['quantity']]);
            }
        }

        return redirect()->route('products.index')
            ->with('success', 'Produit créé avec succès.');
    } catch (\Exception $e) {
        Log::error('Product creation failed', [
            'error' => $e->getMessage(),
            'data' => $request->all()
        ]);
        return back()->withInput()->withErrors(['error' => $e->getMessage()]);
    }
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        $product->load(['ingredients', 'category']);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
{
    $product->load('ingredients', 'category');
    $categories = Category::all();
    $ingredients = Ingredient::all();
    $productIngredients = $product->ingredients->pluck('pivot.quantity', 'id')->toArray();
    
    return view('products.edit', compact('product', 'categories', 'ingredients', 'productIngredients'));
}

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        Log::info('Product update attempt', $request->all());
        
        try {
            $validated = $request->validate([
                'name_fr' => 'required|string|max:255',
                'name_en' => 'required|string|max:255',
                'name_it' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'delivery_price' => 'required|numeric|min:0',
                'category_ids' => 'required|array',
                'category_ids.*' => 'exists:categories,id',
                'sku' => 'required|string|unique:products,sku,' . $product->id,
                'stock' => 'required|integer|min:0',
                'ingredients' => 'array',
                'ingredients.*.id' => 'nullable|exists:ingredients,id',
                'ingredients.*.quantity' => 'nullable|numeric|min:0'
            ]);
    
            $product->update([
                'name_fr' => $validated['name_fr'],
                'name_en' => $validated['name_en'],
                'name_it' => $validated['name_it'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'delivery_price' => $validated['delivery_price'],
                'category_id' => $validated['category_ids'][0],
                'sku' => $validated['sku'],
                'stock' => $validated['stock']
            ]);
    
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($product->image_path) {
                    Storage::disk('public')->delete($product->image_path);
                }
                
                $image = $request->file('image');
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('products', $filename, 'public');
                $product->image_path = $path;
                $product->save();
            }
    
            // Sync ingredients
            $product->ingredients()->detach();
            foreach ($validated['ingredients'] as $id => $data) {
                if (isset($data['id']) && isset($data['quantity']) && $data['quantity'] !== null) {
                    $product->ingredients()->attach($data['id'], ['quantity' => $data['quantity']]);
                }
            }
    
            return redirect()->route('products.index')
                ->with('success', 'Produit mis à jour avec succès.');
        } catch (\Exception $e) {
            Log::error('Product update failed', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
        
        $product->ingredients()->detach();
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produit supprimé avec succès.');
    }
}
