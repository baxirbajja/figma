<x-app-layout>
    <div class="container-fluid">
        <h1 class="text-xl mb-4">Nouveau produits</h1>
        <p class="text-gray-600 mb-6">Veuillez sélectionner un thèmes pour votre site</p>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Language Tabs -->
                        <ul class="nav nav-tabs mb-3" id="languageTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="french-tab" data-bs-toggle="tab" data-bs-target="#french" type="button" role="tab">
                                    Français
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="english-tab" data-bs-toggle="tab" data-bs-target="#english" type="button" role="tab">
                                    English
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="italian-tab" data-bs-toggle="tab" data-bs-target="#italian" type="button" role="tab">
                                    Italiano
                                </button>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content" id="languageTabsContent">
                            <!-- French -->
                            <div class="tab-pane fade show active" id="french" role="tabpanel">
                                <div class="mb-3">
                                    <label for="name_fr" class="form-label">Nom (FR)</label>
                                    <input type="text" class="form-control @error('name_fr') is-invalid @enderror" 
                                           id="name_fr" name="name_fr" value="{{ old('name_fr') }}" required>
                                    @error('name_fr')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- English -->
                            <div class="tab-pane fade" id="english" role="tabpanel">
                                <div class="mb-3">
                                    <label for="name_en" class="form-label">Name (EN)</label>
                                    <input type="text" class="form-control @error('name_en') is-invalid @enderror" 
                                           id="name_en" name="name_en" value="{{ old('name_en') }}" required>
                                    @error('name_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Italian -->
                            <div class="tab-pane fade" id="italian" role="tabpanel">
                                <div class="mb-3">
                                    <label for="name_it" class="form-label">Nome (IT)</label>
                                    <input type="text" class="form-control @error('name_it') is-invalid @enderror" 
                                           id="name_it" name="name_it" value="{{ old('name_it') }}" required>
                                    @error('name_it')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Other Fields -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Prix emporter</label>
                            <div class="input-group">
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                       id="price" name="price" value="{{ old('price') }}" required>
                                <span class="input-group-text">€</span>
                            </div>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="delivery_price" class="form-label">Prix livraison</label>
                            <div class="input-group">
                                <input type="number" step="0.01" class="form-control @error('delivery_price') is-invalid @enderror" 
                                       id="delivery_price" name="delivery_price" value="{{ old('delivery_price') }}" required>
                                <span class="input-group-text">€</span>
                            </div>
                            @error('delivery_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="categories" class="form-label">Catégories</label>
                            <div class="row">
                                @foreach($categories as $category)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="category_ids[]" value="{{ $category->id }}"
                                                   id="category_{{ $category->id }}"
                                                   {{ in_array($category->id, old('category_ids', [])) ? 'checked' : '' }}>
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
                            <label for="sku" class="form-label">SKU</label>
                            <input type="text" class="form-control @error('sku') is-invalid @enderror" 
                                   id="sku" name="sku" value="{{ old('sku') }}" required>
                            @error('sku')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                                   id="stock" name="stock" value="{{ old('stock') }}" required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
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

                        <!-- Ingredients Section -->
                        <div class="mb-3">
                            <label class="form-label">Ingrédients</label>
                            <div class="row">
                                @foreach($ingredients as $ingredient)
                                    <div class="col-md-6 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input ingredient-checkbox" type="checkbox" 
                                                           id="ingredient_{{ $ingredient->id }}"
                                                           data-ingredient-id="{{ $ingredient->id }}">
                                                    <label class="form-check-label" for="ingredient_{{ $ingredient->id }}">
                                                        {{ $ingredient->name }}
                                                    </label>
                                                </div>
                                                <div class="ingredient-details" id="details_{{ $ingredient->id }}" style="display: none;">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input type="number" step="0.01" 
                                                                   class="form-control mb-2"
                                                                   name="ingredients[{{ $ingredient->id }}][quantity]"
                                                                   placeholder="Quantité"
                                                                   disabled>
                                                            <input type="hidden" name="ingredients[{{ $ingredient->id }}][id]" 
                                                                   value="{{ $ingredient->id }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select class="form-select"
                                                                    name="ingredients[{{ $ingredient->id }}][unit]"
                                                                    disabled>
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
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Créer le produit</button>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i>
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
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

        document.addEventListener('DOMContentLoaded', function() {
            // Handle ingredient checkboxes
            document.querySelectorAll('.ingredient-checkbox').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const ingredientId = this.dataset.ingredientId;
                    const details = document.querySelector(`#details_${ingredientId}`);
                    const inputs = details.querySelectorAll('input:not([type="hidden"]), select');
                    
                    if (this.checked) {
                        details.style.display = 'block';
                        inputs.forEach(input => input.disabled = false);
                    } else {
                        details.style.display = 'none';
                        inputs.forEach(input => {
                            input.disabled = true;
                            input.value = '';
                        });
                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
