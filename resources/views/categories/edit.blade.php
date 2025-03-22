<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold">Modifier la catégorie</h2>
                        <p class="text-gray-600">Modifier les détails de la catégorie</p>
                    </div>

                    <form action="{{ route('categories.update', $category) }}" method="POST" class="max-w-2xl">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label required">Nom</label>
                            <input type="text" 
                                   id="name"
                                   name="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $category->name) }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Icon -->
                        <div class="mb-4">
                            <label for="icon" class="form-label required">Icône</label>
                            <div class="input-group">
                                <span class="input-group-text">bi-</span>
                                <input type="text" 
                                       id="icon"
                                       name="icon" 
                                       class="form-control @error('icon') is-invalid @enderror"
                                       value="{{ old('icon', str_replace('bi-', '', $category->icon)) }}"
                                       required>
                            </div>
                            <small class="text-muted">
                                Consultez <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a> pour la liste des icônes disponibles
                            </small>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       name="is_active" 
                                       id="is_active"
                                       value="1"
                                       {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Actif</label>
                            </div>
                            <small class="text-muted">
                                Les catégories inactives ne seront pas affichées dans les listes de produits
                            </small>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="mt-6 flex items-center gap-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Enregistrer les modifications
                            </button>
                            <a href="{{ route('categories.manage') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i>Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
