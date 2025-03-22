<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-2xl font-semibold">{{ $category->name }}</h2>
                            <p class="text-gray-600">Détails de la catégorie</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary">
                                <i class="bi bi-pencil me-2"></i>Modifier
                            </a>
                            <a href="{{ route('categories.manage') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Retour
                            </a>
                        </div>
                    </div>

                    <!-- Category Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title h5 mb-4">Informations</h3>
                                <dl class="row">
                                    <dt class="col-sm-4">Icône</dt>
                                    <dd class="col-sm-8">
                                        <i class="bi {{ $category->icon }} me-2"></i>
                                        <code>{{ $category->icon }}</code>
                                    </dd>

                                    <dt class="col-sm-4">Status</dt>
                                    <dd class="col-sm-8">
                                        @if($category->is_active)
                                            <span class="badge bg-success">Actif</span>
                                        @else
                                            <span class="badge bg-danger">Inactif</span>
                                        @endif
                                    </dd>

                                    <dt class="col-sm-4">Créé le</dt>
                                    <dd class="col-sm-8">{{ $category->created_at->format('d/m/Y H:i') }}</dd>

                                    <dt class="col-sm-4">Dernière modification</dt>
                                    <dd class="col-sm-8">{{ $category->updated_at->format('d/m/Y H:i') }}</dd>
                                </dl>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title h5 mb-4">Statistiques</h3>
                                <dl class="row">
                                    <dt class="col-sm-8">Nombre de produits</dt>
                                    <dd class="col-sm-4">{{ $category->products->count() }}</dd>

                                    <dt class="col-sm-8">Produits actifs</dt>
                                    <dd class="col-sm-4">{{ $category->products->where('is_active', true)->count() }}</dd>

                                    <dt class="col-sm-8">Produits inactifs</dt>
                                    <dd class="col-sm-4">{{ $category->products->where('is_active', false)->count() }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>

                    <!-- Products in Category -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="card-title h5 mb-0">Produits dans cette catégorie</h3>
                                <a href="{{ route('products.create', ['category_id' => $category->id]) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-plus-circle me-2"></i>Ajouter un produit
                                </a>
                            </div>

                            @if($category->products->isNotEmpty())
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Prix</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($category->products as $product)
                                                <tr>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ number_format($product->price, 2) }} €</td>
                                                    <td>
                                                        @if($product->is_active)
                                                            <span class="badge bg-success">Actif</span>
                                                        @else
                                                            <span class="badge bg-danger">Inactif</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4 text-muted">
                                    Aucun produit dans cette catégorie
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
