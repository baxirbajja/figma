<x-app-layout>
    <div class="products-container">
        <div class="products-content">
            <!-- Header -->
            <h1 class="page-title">gestion des produits</h1>
            <p class="page-subtitle">veuillez seléctionnner un thémes pour votre site</p>

            <!-- Top Controls -->
            <div class="controls-row">
                <!-- Toggle Switch -->
                <div class="toggle-wrapper">
                    <label class="toggle">
                        <input type="checkbox" checked>
                        <span class="toggle-slider">
                            <span class="toggle-text">ON</span>
                        </span>
                    </label>
                    <span class="toggle-label">L'affiche produit est activé</span>
                </div>

                <!-- Search Bar -->
                <div class="search-bar">
                    <input type="text" placeholder="Recherche">
                    <button type="button" class="search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>

                <!-- Language Selector -->
                <div class="lang-selector">
                    <span>Fr</span>
                    <i class="fas fa-chevron-down"></i>
                </div>

                <!-- New Product Button -->
                <button class="btn-new-product">
                    <i class="fas fa-plus"></i>
                    <span>NOUVEAU PRODUIT</span>
                </button>
            </div>

            <!-- Category Navigation -->
            <nav class="category-nav">
                <a href="#" class="category-link active">Hot Dishes</a>
                <a href="#" class="category-link">Cold Dishes</a>
                <a href="#" class="category-link">Soup</a>
                <a href="#" class="category-link">Grill</a>
                <a href="#" class="category-link">Appetizer</a>
                <a href="#" class="category-link">Dessert</a>
                <button class="more-button">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
            </nav>

            <!-- Products Table -->
            <div class="table-container">
                <table class="products-table">
                    <thead>
                        <tr>
                            <th>Slide1</th>
                            <th>Slide2</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Emporter</th>
                            <th>Livraison</th>
                            <th>INGREDIENTS</th>
                            <th>Title</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>
                                <div class="product-images">
                                    @if($product->images)
                                        @foreach($product->images as $image)
                                        <img src="{{ asset($image) }}" alt="Product image" class="product-image">
                                        @endforeach
                                    @endif
                                </div>
                            </td>
                            <td>
                                <label class="toggle small">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider">
                                        <span class="toggle-text">ON</span>
                                    </span>
                                </label>
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ number_format($product->takeaway_price, 2) }}€</td>
                            <td>{{ number_format($product->delivery_price, 2) }}€</td>
                            <td>
                                <div class="ingredients-list">
                                    @foreach($product->ingredients as $ingredient)
                                    <div class="ingredient-tag">
                                        <span>{{ $ingredient->name }}</span>
                                        <button class="remove-ingredient" type="button">&times;</button>
                                    </div>
                                    @endforeach
                                </div>
                            </td>
                            <td>{{ $product->title }}</td>
                            <td>
                                <div class="action-buttons">
                                    <button type="button" class="btn-action" title="Add">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <button type="button" class="btn-action" title="Link">
                                        <i class="fas fa-link"></i>
                                    </button>
                                    <button type="button" class="btn-action" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class="btn-action delete" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                @for($i = 1; $i <= ceil($products->total() / $products->perPage()); $i++)
                    <button class="page-button {{ $i === $products->currentPage() ? 'active' : '' }}">
                        {{ $i }}
                    </button>
                @endfor
            </div>
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/products-manage.css') }}">
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Category navigation
            const categoryLinks = document.querySelectorAll('.category-link');
            categoryLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    categoryLinks.forEach(l => l.classList.remove('active'));
                    link.classList.add('active');
                });
            });

            // Ingredient removal
            const removeButtons = document.querySelectorAll('.remove-ingredient');
            removeButtons.forEach(button => {
                button.addEventListener('click', () => {
                    button.closest('.ingredient-tag').remove();
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
