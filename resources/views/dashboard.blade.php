<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <!-- Total Products Card -->
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                @php
                                    $productCount = \App\Models\Product::count();
                                @endphp
                                <h3 class="h2 mb-0">{{ $productCount }}</h3>
                                <p class="text-muted mb-0">Produits</p>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-primary text-white rounded-circle shadow text-center">
                                    <i class="bi bi-box"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Categories Card -->
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                @php
                                    $categoryCount = \App\Models\Category::count();
                                @endphp
                                <h3 class="h2 mb-0">{{ $categoryCount }}</h3>
                                <p class="text-muted mb-0">Catégories</p>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-success text-white rounded-circle shadow text-center">
                                    <i class="bi bi-folder"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Ingredients Card -->
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                @php
                                    $ingredientCount = \App\Models\Ingredient::count();
                                @endphp
                                <h3 class="h2 mb-0">{{ $ingredientCount }}</h3>
                                <p class="text-muted mb-0">Ingrédients</p>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-warning text-white rounded-circle shadow text-center">
                                    <i class="bi bi-list-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Products Card -->
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                @php
                                    $activeProductCount = \App\Models\Product::where('is_active', true)->count();
                                @endphp
                                <h3 class="h2 mb-0">{{ $activeProductCount }}</h3>
                                <p class="text-muted mb-0">Produits actifs</p>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-info text-white rounded-circle shadow text-center">
                                    <i class="bi bi-check-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Products Table -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Produits récents</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Catégorie</th>
                                    <th>Prix</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\Product::with('category')->latest()->take(5)->get() as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category?->name ?? 'Non catégorisé' }}</td>
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
                                            ✏️
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
