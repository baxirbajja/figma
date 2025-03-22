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

                        <div class="mb-4">
                            <label class="form-label">Title</label>
                            <input type="text" 
                                   name="title" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                                               class="form-check-input">
                                        <label class="form-check-label" for="ingredient{{ $ingredient->id }}">
                                            {{ $ingredient->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="mb-4">
                            <label class="form-label">Catégorie</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="d-block mb-2">Boisson:</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="drink1">
                                        <label class="form-check-label" for="drink1">
                                            Coca-cola 33cl
                                            <span class="text-muted">+ 1.50€</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="drink2">
                                        <label class="form-check-label" for="drink2">
                                            Fanta 33cl
                                            <span class="text-muted">+ 1.50€</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="d-block mb-2">Accompagnement:</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="side1">
                                        <label class="form-check-label" for="side1">
                                            Frites Belge
                                            <span class="text-muted">+ 1.50€</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="side2">
                                        <label class="form-check-label" for="side2">
                                            Potatoes
                                            <span class="text-muted">+ 1.50€</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="d-block mb-2">Choix sauce:</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="sauce1">
                                        <label class="form-check-label" for="sauce1">
                                            Andalouse
                                            <span class="text-muted">+ 0.50€</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="sauce2">
                                        <label class="form-check-label" for="sauce2">
                                            Mayonnaise
                                            <span class="text-muted">+ 0.50€</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Toggles -->
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input type="checkbox" 
                                       name="active" 
                                       id="active" 
                                       class="form-check-input" 
                                       value="1" 
                                       {{ old('active', '1') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="active">
                                    Actif dans la menu
                                </label>
                            </div>
                            <div class="form-check form-switch">
                                <input type="checkbox" 
                                       name="featured" 
                                       id="featured" 
                                       class="form-check-input" 
                                       value="1" 
                                       {{ old('featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="featured">
                                    Produit visible dans la premiere date
                                </label>
                            </div>
                            <div class="form-check form-switch">
                                <input type="checkbox" 
                                       name="show_in_menu" 
                                       id="show_in_menu" 
                                       class="form-check-input" 
                                       value="1" 
                                       {{ old('show_in_menu') ? 'checked' : '' }}>
                                <label class="form-check-label" for="show_in_menu">
                                    Produit visible dans le premier état
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4">
                                AJOUTER
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
