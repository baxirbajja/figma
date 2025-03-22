<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Gestion des catégories</h2>
                        <a href="{{ route('categories.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Nouvelle catégorie
                        </a>
                    </div>

                    <!-- Search Bar -->
                    <div class="mb-4">
                        <form action="{{ route('categories.manage') }}" method="GET" class="flex gap-4">
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
                                    <th>Image</th>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Meta Title</th>
                                    <th>Nombre de produits</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                <tr>
                                    <td>
                                        @if($category->image)
                                            <img src="{{ Storage::url($category->image) }}" 
                                                 alt="{{ $category->name }}"
                                                 class="img-thumbnail"
                                                 style="max-width: 50px;">
                                        @else
                                            <span class="text-muted">Aucune image</span>
                                        @endif
                                    </td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ Str::limit($category->description, 50) }}</td>
                                    <td>{{ $category->meta_title }}</td>
                                    <td>{{ $category->products->count() }}</td>
                                    <td>
                                        @if($category->is_active)
                                            <span class="badge bg-success">Actif</span>
                                        @else
                                            <span class="badge bg-danger">Inactif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="{{ route('categories.show', $category) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
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
                                    <td colspan="7" class="text-center py-4">
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
</x-app-layout>
