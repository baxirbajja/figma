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
            <h2 class="mb-3">Gestion des Produits</h2>
            
            <!-- Search & Button -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <form action="{{ route('products.index') }}" method="GET" class="w-25">
                    <input type="text" name="search" class="form-control" placeholder="Recherche..." value="{{ request('search') }}">
                </form>
                <a href="{{ route('products.create') }}" class="btn btn-danger">+ NOUVEAU PRODUIT</a>
            </div>

            <!-- Tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ !request('category') ? 'active' : '' }}" href="{{ route('products.index') }}">All</a>
                </li>
                @foreach($categories as $category)
                <li class="nav-item">
                    <a class="nav-link {{ request('category') == $category->id ? 'active' : '' }}" 
                       href="{{ route('products.index', ['category' => $category->id]) }}">
                        <i class="bi {{ $category->icon }}"></i>
                        {{ $category->name }}
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
                        <th>Catégorie</th>
                        <th>Emporter</th>
                        <th>Livraison</th>
                        <th>Ingrédients</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>
                            @if($product->image_path)
                                <img src="{{ Storage::url($product->image_path) }}" class="rounded" alt="{{ $product->name }}" width="50">
                            @else
                                <img src="https://via.placeholder.com/50" class="rounded" alt="No Image">
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            @if($product->category)
                                <span class="badge bg-secondary">
                                    <i class="bi {{ $product->category->icon }}"></i>
                                    {{ $product->category->name }}
                                </span>
                            @else
                                <span class="badge bg-light text-dark">No Category</span>
                            @endif
                        </td>
                        <td>{{ number_format($product->price, 2) }}€</td>
                        <td>{{ number_format($product->price, 2) }}€</td>
                        <td>
                            @if($product->ingredients)
                                @foreach($product->ingredients as $ingredient)
                                    <span class="badge bg-secondary">{{ $ingredient->name }}</span>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary">✏️</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">🗑️</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No products found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
</x-app-layout>
