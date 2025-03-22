<x-app-layout>
    <div class="container-fluid">
        <h1 class="text-xl mb-4">Tableau de bord</h1>
        <p class="text-gray-600 mb-6">Vue d'ensemble de votre activité</p>

        <div class="row g-4">
            <!-- Orders Overview Card -->
            <div class="col-md-6 col-lg-3">
                <div class="bg-white rounded-lg shadow-sm p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                            <i class="fas fa-shopping-cart text-primary"></i>
                        </div>
                        <div class="text-end">
                            <h3 class="h2 mb-0">{{ \App\Models\Order::count() }}</h3>
                            <p class="text-muted mb-0">Commandes</p>
                        </div>
                    </div>
                    <a href="{{ route('orders.index') }}" class="text-primary text-decoration-none">
                        Voir tout <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <!-- Products Overview Card -->
            <div class="col-md-6 col-lg-3">
                <div class="bg-white rounded-lg shadow-sm p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3">
                            <i class="fas fa-box text-success"></i>
                        </div>
                        <div class="text-end">
                            <h3 class="h2 mb-0">{{ \App\Models\Product::count() }}</h3>
                            <p class="text-muted mb-0">Produits</p>
                        </div>
                    </div>
                    <a href="{{ route('products.index') }}" class="text-success text-decoration-none">
                        Voir tout <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <!-- Ingredients Overview Card -->
            <div class="col-md-6 col-lg-3">
                <div class="bg-white rounded-lg shadow-sm p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                            <i class="fas fa-leaf text-warning"></i>
                        </div>
                        <div class="text-end">
                            <h3 class="h2 mb-0">{{ \App\Models\Ingredient::count() }}</h3>
                            <p class="text-muted mb-0">Ingrédients</p>
                        </div>
                    </div>
                    <a href="{{ route('ingredients.index') }}" class="text-warning text-decoration-none">
                        Voir tout <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <!-- Low Stock Alert Card -->
            <div class="col-md-6 col-lg-3">
                <div class="bg-white rounded-lg shadow-sm p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="rounded-circle bg-danger bg-opacity-10 p-3">
                            <i class="fas fa-exclamation-triangle text-danger"></i>
                        </div>
                        <div class="text-end">
                            @php
                                $lowStockCount = \App\Models\Product::where('stock', '<', 10)->count() +
                                               \App\Models\Ingredient::where('stock', '<', 10)->count();
                            @endphp
                            <h3 class="h2 mb-0">{{ $lowStockCount }}</h3>
                            <p class="text-muted mb-0">Alertes stock</p>
                        </div>
                    </div>
                    <a href="#" class="text-danger text-decoration-none" data-bs-toggle="modal" data-bs-target="#lowStockModal">
                        Voir détails <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-lg">Commandes récentes</h2>
                <a href="{{ route('orders.index') }}" class="btn btn-outline-primary btn-sm">
                    Voir toutes les commandes
                </a>
            </div>

            <div class="bg-white rounded-lg shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Numéro</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Order::with('user')->latest()->take(5)->get() as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status === 'completed' ? 'success' : 
                                            ($order->status === 'cancelled' ? 'danger' : 
                                            ($order->status === 'processing' ? 'warning' : 'info')) }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>{{ number_format($order->total_amount, 2) }} €</td>
                                    <td>
                                        <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-eye"></i>
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

    <!-- Low Stock Modal -->
    <div class="modal fade" id="lowStockModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alertes de stock bas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @php
                        $lowStockProducts = \App\Models\Product::where('stock', '<', 10)->get();
                        $lowStockIngredients = \App\Models\Ingredient::where('stock', '<', 10)->get();
                    @endphp

                    @if($lowStockProducts->isNotEmpty())
                        <h6 class="mb-3">Produits</h6>
                        <div class="list-group mb-4">
                            @foreach($lowStockProducts as $product)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $product->name }}</span>
                                    <span class="badge bg-danger">{{ $product->stock }} restants</span>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if($lowStockIngredients->isNotEmpty())
                        <h6 class="mb-3">Ingrédients</h6>
                        <div class="list-group">
                            @foreach($lowStockIngredients as $ingredient)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $ingredient->name }}</span>
                                    <span class="badge bg-danger">{{ $ingredient->stock }} restants</span>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if($lowStockProducts->isEmpty() && $lowStockIngredients->isEmpty())
                        <p class="text-muted mb-0">Aucune alerte de stock bas</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
