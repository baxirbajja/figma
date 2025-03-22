<x-app-layout>
    <div class="container-fluid">
        <h1 class="text-xl mb-4">Gestion des ingrédients</h1>
        <p class="text-gray-600 mb-6">Veuillez sélectionner un thèmes pour votre site</p>

        <!-- Top Bar -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="input-group" style="max-width: 300px;">
                <input type="text" class="form-control" placeholder="Recherche">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <a href="{{ route('ingredients.create') }}" class="btn btn-primary">
                + NOUVEAU INGRÉDIENT
            </a>
        </div>

        <!-- Ingredients Table -->
        <div class="bg-white rounded-lg shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Référence</th>
                            <th>Nom (Fr)</th>
                            <th>Nom (En)</th>
                            <th>Nom (Nl)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ingredients as $ingredient)
                        <tr>
                            <td>{{ $ingredient->id }}</td>
                            <td>{{ $ingredient->name }}</td>
                            <td>{{ $ingredient->name_en ?? 'something' }}</td>
                            <td>{{ $ingredient->name_nl ?? 'something' }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('ingredients.show', $ingredient) }}" 
                                       class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    <a href="{{ route('ingredients.edit', $ingredient) }}" 
                                       class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-sync-alt"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <form action="{{ route('ingredients.destroy', $ingredient) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('Are you sure you want to delete this ingredient?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    No ingredients found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center py-3">
                {{ $ingredients->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
