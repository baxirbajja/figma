<x-app-layout>
    <div class="container-fluid">
        <h1 class="text-xl mb-4">Nouveau produits</h1>
        <p class="text-gray-600 mb-6">Veuillez sélectionner un thèmes pour votre site</p>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Left Column - Image Upload -->
                    <div class="col-md-4">
                        <div class="mb-4">
                            <div class="position-relative" style="width: 300px; height: 300px;">
                                <label for="image" class="d-block w-100 h-100 border rounded-lg cursor-pointer overflow-hidden">
                                    <img id="image-preview" src="#" alt="Preview" class="w-100 h-100 object-cover d-none">
                                    <div id="image-placeholder" class="w-100 h-100 d-flex align-items-center justify-content-center bg-light">
                                        <span class="text-gray-500">Click to upload image</span>
                                    </div>
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
                                       value="{{ old('name') }}" 
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
                                       value="{{ old('sku') }}" 
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
                                       value="{{ old('stock', 0) }}" 
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
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                      rows="3">{{ old('description') }}</textarea>
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
                                           value="{{ old('price') }}" 
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
                                           value="{{ old('delivery_price') }}" 
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
                            <label class="form-label">Ingrédients</label>
                            <div class="ingredients-container">
                                @foreach($ingredients as $ingredient)
                                    <div class="ingredient-item card mb-2">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input type="checkbox" 
                                                               name="ingredients[{{ $ingredient->id }}][id]" 
                                                               value="{{ $ingredient->id }}" 
                                                               id="ingredient{{ $ingredient->id }}" 
                                                               class="form-check-input ingredient-checkbox"
                                                               {{ in_array($ingredient->id, old('ingredients', [])) ? 'checked' : '' }}
                                                               onchange="toggleIngredientInputs(this)">
                                                        <label class="form-check-label" for="ingredient{{ $ingredient->id }}">
                                                            {{ $ingredient->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" 
                                                           name="ingredients[{{ $ingredient->id }}][quantity]" 
                                                           class="form-control ingredient-input" 
                                                           placeholder="Quantité"
                                                           step="0.01"
                                                           min="0"
                                                           disabled>
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="ingredients[{{ $ingredient->id }}][unit]" 
                                                            class="form-select ingredient-input"
                                                            disabled>
                                                        <option value="">Unité</option>
                                                        <option value="g">Grammes (g)</option>
                                                        <option value="kg">Kilogrammes (kg)</option>
                                                        <option value="ml">Millilitres (ml)</option>
                                                        <option value="l">Litres (l)</option>
                                                        <option value="pcs">Pièces (pcs)</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('ingredients')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                            @error('ingredients.*.quantity')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                            @error('ingredients.*.unit')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-plus-circle me-2"></i>
                                Créer le produit
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i>
                                Annuler
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image-preview').src = e.target.result;
                    document.getElementById('image-preview').classList.remove('d-none');
                    document.getElementById('image-placeholder').classList.add('d-none');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function toggleIngredientInputs(checkbox) {
            const container = checkbox.closest('.ingredient-item');
            const inputs = container.querySelectorAll('.ingredient-input');
            inputs.forEach(input => {
                input.disabled = !checkbox.checked;
                if (!checkbox.checked) {
                    input.value = '';
                }
            });
        }

        // Initialize ingredient inputs state
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.ingredient-checkbox').forEach(function(checkbox) {
                toggleIngredientInputs(checkbox);
            });
        });
    </script>
    @endpush
</x-app-layout>
