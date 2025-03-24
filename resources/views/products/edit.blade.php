<x-app-layout>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Modifier le produit</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name_fr" class="form-label">Nom (FR)</label>
                            <input type="text" class="form-control @error('name_fr') is-invalid @enderror" 
                                   id="name_fr" name="name_fr" value="{{ old('name_fr', $product->name_fr) }}" required>
                            @error('name_fr')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name_en" class="form-label">Nom (EN)</label>
                            <input type="text" class="form-control @error('name_en') is-invalid @enderror" 
                                   id="name_en" name="name_en" value="{{ old('name_en', $product->name_en) }}" required>
                            @error('name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name_it" class="form-label">Nom (IT)</label>
                            <input type="text" class="form-control @error('name_it') is-invalid @enderror" 
                                   id="name_it" name="name_it" value="{{ old('name_it', $product->name_it) }}" required>
                            @error('name_it')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                    id="description" name="description">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Prix</label>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price', $product->price) }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="delivery_price" class="form-label">Prix de livraison</label>
                            <input type="number" step="0.01" class="form-control @error('delivery_price') is-invalid @enderror" 
                                   id="delivery_price" name="delivery_price" value="{{ old('delivery_price', $product->delivery_price) }}" required>
                            @error('delivery_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sku" class="form-label">SKU</label>
                            <input type="text" class="form-control @error('sku') is-invalid @enderror" 
                                   id="sku" name="sku" value="{{ old('sku', $product->sku) }}" required>
                            @error('sku')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                                   id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required min="0">
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catégories</label>
                            <div class="row">
                                @foreach($categories as $category)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="category_ids[]" value="{{ $category->id }}"
                                                   id="category_{{ $category->id }}"
                                                   {{ in_array($category->id, old('category_ids', [$product->category_id])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="category_{{ $category->id }}">
                                                {{ $category->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('category_ids')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            @if($product->image_path)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($product->image_path) }}" alt="Current image" class="img-thumbnail" style="max-height: 200px;">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ingrédients</label>
                            <div class="row">
                                @foreach($ingredients as $ingredient)
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="ingredients[{{ $ingredient->id }}][id]" 
                                                   value="{{ $ingredient->id }}"
                                                   id="ingredient_{{ $ingredient->id }}"
                                                   {{ isset($productIngredients[$ingredient->id]) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="ingredient_{{ $ingredient->id }}">
                                                {{ $ingredient->name_fr }}
                                            </label>
                                            <input type="number" 
                                                   class="form-control mt-1" 
                                                   name="ingredients[{{ $ingredient->id }}][quantity]" 
                                                   placeholder="Quantity"
                                                   value="{{ $productIngredients[$ingredient->id] ?? '' }}"
                                                   step="0.01"
                                                   min="0">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('ingredients')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
