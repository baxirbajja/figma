<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold">Nouvelle catégorie</h2>
                        <p class="text-gray-600">Créer une nouvelle catégorie pour vos produits</p>
                    </div>

                    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl">
                        @csrf

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label required">Nom</label>
                            <input type="text" 
                                   id="name"
                                   name="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description"
                                    name="description" 
                                    rows="4"
                                    class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Meta Title -->
                        <div class="mb-4">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <input type="text" 
                                   id="meta_title"
                                   name="meta_title" 
                                   class="form-control @error('meta_title') is-invalid @enderror" 
                                   value="{{ old('meta_title') }}">
                            <small class="text-muted">
                                Le titre qui apparaîtra dans les résultats de recherche
                            </small>
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div class="mb-4">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" 
                                   id="image"
                                   name="image" 
                                   class="form-control @error('image') is-invalid @enderror"
                                   accept="image/*">
                            <small class="text-muted">
                                Format recommandé: JPG, PNG. Taille maximale: 2MB
                            </small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Buttons -->
                        <div class="mt-6 flex items-center gap-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Créer la catégorie
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
