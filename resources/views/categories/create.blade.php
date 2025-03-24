<x-app-layout>
    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    @endpush

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

                        <!-- Name Fields -->
                        <ul class="nav nav-tabs mb-3" id="langTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#fr" type="button">Français</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#en" type="button">English</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#it" type="button">Italiano</button>
                            </li>
                        </ul>

                        <div class="tab-content mb-4" id="langTabsContent">
                            <!-- French -->
                            <div class="tab-pane fade show active" id="fr">
                                <div class="mb-3">
                                    <label for="name_fr" class="form-label required">Nom (FR)</label>
                                    <input type="text" 
                                           id="name_fr"
                                           name="name_fr" 
                                           class="form-control @error('name_fr') is-invalid @enderror" 
                                           value="{{ old('name_fr') }}" 
                                           required>
                                    @error('name_fr')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- English -->
                            <div class="tab-pane fade" id="en">
                                <div class="mb-3">
                                    <label for="name_en" class="form-label required">Name (EN)</label>
                                    <input type="text" 
                                           id="name_en"
                                           name="name_en" 
                                           class="form-control @error('name_en') is-invalid @enderror" 
                                           value="{{ old('name_en') }}" 
                                           required>
                                    @error('name_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Italian -->
                            <div class="tab-pane fade" id="it">
                                <div class="mb-3">
                                    <label for="name_it" class="form-label required">Nome (IT)</label>
                                    <input type="text" 
                                           id="name_it"
                                           name="name_it" 
                                           class="form-control @error('name_it') is-invalid @enderror" 
                                           value="{{ old('name_it') }}" 
                                           required>
                                    @error('name_it')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
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
                            <button type="submit" class="btn btn-danger " style="background-color: #D22254; width: 253px !important;">
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

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
</x-app-layout>
