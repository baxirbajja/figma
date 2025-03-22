<x-app-layout>
    <div class="container-fluid">
        <h1 class="text-xl mb-4">Modifier le produit</h1>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Left Column - Image Upload -->
                    <div class="col-md-4">
                        <div class="mb-4">
                            <div class="position-relative" style="width: 300px; height: 300px;">
                                <label for="image" class="d-block w-100 h-100 border rounded-lg cursor-pointer overflow-hidden">
                                    @if($product->image_path)
                                        <img id="image-preview" src="{{ Storage::url($product->image_path) }}" alt="Preview" class="w-100 h-100 object-cover">
                                        <div id="image-placeholder" class="w-100 h-100 d-flex align-items-center justify-content-center bg-light d-none">
                                            <span class="text-gray-500">Click to upload image</span>
                                        </div>
                                    @else
                                        <img id="image-preview" src="#" alt="Preview" class="w-100 h-100 object-cover d-none">
                                        <div id="image-placeholder" class="w-100 h-100 d-flex align-items-center justify-content-center bg-light">
                                            <span class="text-gray-500">Click to upload image</span>
                                        </div>
                                    @endif
                                </label>
                                <input type="file" 
                                       id="image" 
                                       name="image" 
                                       class="position-absolute" 
                                       style="opacity: 0; width: 0; height: 0;"
                                       accept="image/*"
                                       onchange="previewImage(this)">
                            </div>
                            @error('image')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column - Product Details -->
                    <div class="col-md-8">
                        <!-- Basic Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="form-label">Nom</label>
                                <div class="btn-group w-100" role="group">
                                    <button type="button" class="btn btn-outline-secondary active">Fr</button>
                                    <button type="button" class="btn btn-outline-secondary">En</button>
                                    <button type="button" class="btn btn-outline-secondary">Nl</button>
                                </div>
                                <input type="text" 
                                       name="name" 
                                       class="form-control mt-2 @error('name') is-invalid @enderror" 
                                       value="{{ old('name', $product->name) }}" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- SKU and Stock -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">SKU</label>
                                <input type="text" 
                                       name="sku" 
                                       class="form-control @error('sku') is-invalid @enderror" 
                                       value="{{ old('sku', $product->sku) }}" 
                                       required>
                                @error('sku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Stock</label>
                                <input type="number" 
                                       name="stock" 
                                       class="form-control @error('stock') is-invalid @enderror" 
                                       value="{{ old('stock', $product->stock) }}" 
                                       min="0" 
                                       required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Category Selection -->
                        <div class="mb-4">
                            <label class="form-label">Catégorie</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="">Sélectionner une catégorie</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label class="form-label">Description</label>
                            <textarea name="description" 
                                      class="form-control @error('description') is-invalid @enderror" 
                                      rows="3">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Prices -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Prix emporter</label>
                                <div class="input-group">
                                    <input type="number" 
                                           name="price" 
                                           class="form-control @error('price') is-invalid @enderror" 
                                           value="{{ old('price', $product->price) }}" 
                                           step="0.01" 
                                           required>
                                    <span class="input-group-text">€</span>
                                </div>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Prix livraison</label>
                                <div class="input-group">
                                    <input type="number" 
                                           name="delivery_price" 
                                           class="form-control @error('delivery_price') is-invalid @enderror" 
                                           value="{{ old('delivery_price', $product->delivery_price) }}" 
                                           step="0.01" 
                                           required>
                                    <span class="input-group-text">€</span>
                                </div>
                                @error('delivery_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Ingredients Section -->
                        <div class="mb-4">
                            <label class="form-label">Ingredients</label>
                            <div class="ingredient-tags">
                                @foreach($ingredients as $ingredient)
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" 
                                               name="ingredients[]" 
                                               value="{{ $ingredient->id }}" 
                                               id="ingredient{{ $ingredient->id }}" 
                                               class="form-check-input"
                                               {{ in_array($ingredient->id, old('ingredients', $product->ingredients->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="ingredient{{ $ingredient->id }}">
                                            {{ $ingredient->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('ingredients')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>
                                Sauvegarder les modifications
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            const placeholder = document.getElementById('image-placeholder');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    placeholder.classList.add('d-none');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @endpush
</x-app-layout>
