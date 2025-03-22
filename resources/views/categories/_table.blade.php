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
