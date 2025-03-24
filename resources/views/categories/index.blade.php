<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Gestion des catégories</h2>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                            <i class="bi bi-plus-circle me-2"></i>Ajouter une catégorie
                        </button>
                    </div>

                    <!-- Search Bar -->
                    <div class="mb-4">
                        <form action="{{ route('categories.index') }}" method="GET" class="flex gap-4">
                            <input type="text" 
                                   name="search" 
                                   class="form-control" 
                                   placeholder="Rechercher une catégorie..."
                                   value="{{ request('search') }}">
                            <button type="submit" class="btn btn-secondary">
                                <i class="bi bi-search me-2"></i>Rechercher
                            </button>
                        </form>
                    </div>

                    <!-- Categories Table -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Ordre</th>
                                    <th>Icône</th>
                                    <th>Nom</th>
                                    <th>Nombre de produits</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                <tr>
                                    <td>{{ $category->sort_order }}</td>
                                    <td><i class="bi {{ $category->icon }}"></i></td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->products->count() }}</td>
                                    <td>
                                        @if($category->is_active)
                                            <span class="badge bg-success">Actif</span>
                                        @else
                                            <span class="badge bg-danger">Inactif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" 
                                                class="btn btn-sm btn-primary"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editCategory{{ $category->id }}">
                                                <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="{{ route('categories.destroy', $category) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ? Tous les produits associés seront affectés.')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        Aucune catégorie trouvée
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" 
                                   name="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icône</label>
                            <div class="input-group">
                                <span class="input-group-text">bi-</span>
                                <input type="text" 
                                       name="icon" 
                                       class="form-control @error('icon') is-invalid @enderror"
                                       placeholder="cart, box, tag, etc." 
                                       required>
                            </div>
                            <small class="text-muted">
                                Consultez <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a> pour la liste des icônes disponibles
                            </small>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ordre de tri</label>
                            <input type="number" 
                                   name="sort_order" 
                                   class="form-control @error('sort_order') is-invalid @enderror" 
                                   value="0" 
                                   required>
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Category Modals -->
    @foreach($categories as $category)
    <div class="modal fade" id="editCategory{{ $category->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier la catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" 
                                   name="name" 
                                   class="form-control" 
                                   value="{{ $category->name }}" 
                                   required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icône</label>
                            <div class="input-group">
                                <span class="input-group-text">bi-</span>
                                <input type="text" 
                                       name="icon" 
                                       class="form-control"
                                       value="{{ str_replace('bi-', '', $category->icon) }}"
                                       required>
                            </div>
                            <small class="text-muted">
                                Consultez <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a> pour la liste des icônes disponibles
                            </small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ordre de tri</label>
                            <input type="number" 
                                   name="sort_order" 
                                   class="form-control" 
                                   value="{{ $category->sort_order }}" 
                                   required>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox" 
                                   name="is_active" 
                                   class="form-check-input" 
                                   id="is_active{{ $category->id }}"
                                   value="1"
                                   {{ $category->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active{{ $category->id }}">Actif</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</x-app-layout>
