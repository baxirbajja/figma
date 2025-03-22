<x-app-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="text-xl">Gestion des ingrédients</h1>
                <p class="text-gray-600">Gérer les ingrédients de vos produits</p>
            </div>
        </div>

        <div class="row">
            <!-- Left Column - Add Ingredient Form -->
            <div class="col-md-4">
                <div class="bg-white rounded-lg shadow-sm p-4">
                    <h2 class="h5 mb-4">Ajouter un ingrédient</h2>
                    
                    <form action="{{ route('ingredients.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Nom (Français)</label>
                            <input type="text" 
                                   name="name_fr" 
                                   class="form-control @error('name_fr') is-invalid @enderror" 
                                   value="{{ old('name_fr') }}" 
                                   required>
                            @error('name_fr')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Name (English)</label>
                            <input type="text" 
                                   name="name_en" 
                                   class="form-control @error('name_en') is-invalid @enderror" 
                                   value="{{ old('name_en') }}" 
                                   required>
                            @error('name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nome (Italiano)</label>
                            <input type="text" 
                                   name="name_it" 
                                   class="form-control @error('name_it') is-invalid @enderror" 
                                   value="{{ old('name_it') }}" 
                                   required>
                            @error('name_it')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-danger w-100">
                            <i class="bi bi-plus-circle me-2"></i>
                            Ajouter
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Column - Ingredients List -->
            <div class="col-md-8">
                <div class="bg-white rounded-lg shadow-sm">
                    <!-- Search Bar -->
                    <div class="p-4 border-bottom">
                        <form action="{{ route('ingredients.index') }}" method="GET" class="d-flex gap-2">
                            <input type="text" 
                                   name="search" 
                                   class="form-control" 
                                   placeholder="Rechercher un ingrédient..."
                                   value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Ingredients Table -->
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Référence</th>
                                    <th>Nom (FR)</th>
                                    <th>Name (EN)</th>
                                    <th>Nome (IT)</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ingredients as $ingredient)
                                <tr>
                                    <td>{{ $ingredient->reference }}</td>
                                    <td>{{ $ingredient->name_fr }}</td>
                                    <td>{{ $ingredient->name_en }}</td>
                                    <td>{{ $ingredient->name_it }}</td>
                                    <td>
                                        <button type="button" 
                                                class="btn btn-sm btn-primary"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editIngredient{{ $ingredient->id }}">
                                            ✏️
                                        </button>
                                        <form action="{{ route('ingredients.destroy', $ingredient) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this ingredient?')">
                                                🗑️
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editIngredient{{ $ingredient->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Modifier l'ingrédient</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('ingredients.update', $ingredient) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Référence</label>
                                                        <input type="text" class="form-control" value="{{ $ingredient->reference }}" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Nom (Français)</label>
                                                        <input type="text" 
                                                               name="name_fr" 
                                                               class="form-control" 
                                                               value="{{ $ingredient->name_fr }}" 
                                                               required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Name (English)</label>
                                                        <input type="text" 
                                                               name="name_en" 
                                                               class="form-control" 
                                                               value="{{ $ingredient->name_en }}" 
                                                               required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Nome (Italiano)</label>
                                                        <input type="text" 
                                                               name="name_it" 
                                                               class="form-control" 
                                                               value="{{ $ingredient->name_it }}" 
                                                               required>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" 
                                                               class="form-check-input" 
                                                               name="is_active" 
                                                               id="is_active{{ $ingredient->id }}"
                                                               value="1"
                                                               {{ $ingredient->is_active ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="is_active{{ $ingredient->id }}">
                                                            Actif
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        Aucun ingrédient trouvé
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="p-4">
                        {{ $ingredients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
