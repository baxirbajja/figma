<x-app-layout>
    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <style>
        .main-content {
            margin-left: 292px;
            padding: 2rem;
            min-height: calc(100vh - 96px);
            background-color: #f8f8f8;
            position: relative;
        }
        .content {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
        }
    </style>
    @endpush

    <!-- Include the sidebar -->
    @include('layouts.sidebar')
    
    <div class="main-content">
        <div class="content">
            <div class="container-fluid px-4">
                <h2 class="mb-3">Gestion des Produits</h2>
                
                <!-- Search & Button -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <form action="{{ route('products.index') }}" method="GET" class="d-flex align-items-center">
                        <input type="text" name="search" class="form-control w-100" style="width: 300px !important;" 
                               placeholder="Recherche..." value="{{ request('search') }}">
                        <select name="language" class="form-select ms-2" style="width: 120px;">
                            <option value="fr" {{ request('language', 'fr') == 'fr' ? 'selected' : '' }}>Français</option>
                            <option value="en" {{ request('language') == 'en' ? 'selected' : '' }}>English</option>
                            <option value="it" {{ request('language') == 'it' ? 'selected' : '' }}>Italiano</option>
                        </select>
                    </form>
                    <a href="{{ route('products.create') }}" class="btn btn-danger">+ NOUVEAU PRODUIT</a>
                </div>

                <!-- Tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link {{ !request('category') ? 'active' : '' }}" 
                           href="{{ route('products.index', ['search' => request('search'), 'language' => request('language')]) }}">
                            Tous
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link {{ request('category') == $category->id ? 'active' : '' }}" 
                               href="{{ route('products.index', ['category' => $category->id, 'search' => request('search'), 'language' => request('language')]) }}">
                                {{ $category->{"name_" . (request('language', 'fr'))} }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <!-- Product Table -->
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Emporter</th>
                            <th>Livraison</th>
                            <th>Catégorie</th>
                            <th>Ingrédients</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    @if($product->image_path)
                                        <img src="{{ Storage::url($product->image_path) }}" class="rounded" alt="{{ $product->name }}" width="50">
                                    @else
                                        <img src="https://via.placeholder.com/50" class="rounded" alt="No Image">
                                    @endif
                                </td>
                                <td>{{ $product->{"name_" . request('language', 'fr')} }}</td>
                                <td>{{ Str::limit($product->description, 50) }}</td>
                                <td>{{ number_format($product->price, 2) }}€</td>
                                <td>{{ number_format($product->delivery_price, 2) }}€</td>
                                <td>{{ $product->category->{"name_" . request('language', 'fr')} }}</td>
                                <td>
                                    @foreach($product->ingredients as $ingredient)
                                        <span class="badge bg-secondary">{{ $ingredient->{"name_" . request('language', 'fr')} }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">✏️</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">🗑️</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
</x-app-layout>
