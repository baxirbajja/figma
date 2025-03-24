<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Menu de gestion</h4>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="{{ route('products.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="bi bi-box me-3"></i>
                                Gérer les produits
                            </a>
                            <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="bi bi-folder me-3"></i>
                                Gérer les catégories
                            </a>
                            <a href="{{ route('ingredients.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="bi bi-list-check me-3"></i>
                                Gérer les ingrédients
                            </a>
                            <a href="{{ route('promo-codes.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
    <i class="bi bi-ticket-perforated me-3"></i>
    Gérer les codes promo
</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>