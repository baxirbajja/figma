<x-app-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="text-xl mb-2">Nouvelle commande</h1>
                <p class="text-gray-600">Créer une nouvelle commande</p>
            </div>
            <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
                Retour à la liste
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-4">
            <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
                @csrf

                <!-- Product Selection -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="text-lg">Produits</h2>
                        <button type="button" class="btn btn-outline-primary btn-sm" id="addProduct">
                            + Ajouter un produit
                        </button>
                    </div>

                    <div id="productsList">
                        <!-- Product items will be added here -->
                    </div>
                </div>

                <!-- Notes -->
                <div class="mb-4">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        CRÉER LA COMMANDE
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Product Item Template -->
    <template id="productItemTemplate">
        <div class="product-item border rounded p-3 mb-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <select name="products[][id]" class="form-select product-select" required>
                        <option value="">Sélectionner un produit</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                {{ $product->name }} - {{ number_format($product->price, 2) }} €
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="number" name="products[][quantity]" class="form-control quantity-input" 
                               value="1" min="1" required>
                        <span class="input-group-text">unité(s)</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="subtotal text-end">0.00 €</div>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-outline-danger btn-sm remove-product">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </template>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productsList = document.getElementById('productsList');
            const addProductBtn = document.getElementById('addProduct');
            const template = document.getElementById('productItemTemplate');

            function updateSubtotal(productItem) {
                const select = productItem.querySelector('.product-select');
                const quantity = productItem.querySelector('.quantity-input').value;
                const option = select.selectedOptions[0];
                const price = option?.dataset?.price || 0;
                const subtotal = price * quantity;
                productItem.querySelector('.subtotal').textContent = subtotal.toFixed(2) + ' €';
            }

            function addProductItem() {
                const clone = template.content.cloneNode(true);
                const productItem = clone.querySelector('.product-item');

                productItem.querySelector('.product-select').addEventListener('change', () => {
                    updateSubtotal(productItem);
                });

                productItem.querySelector('.quantity-input').addEventListener('input', () => {
                    updateSubtotal(productItem);
                });

                productItem.querySelector('.remove-product').addEventListener('click', () => {
                    productItem.remove();
                });

                productsList.appendChild(productItem);
            }

            addProductBtn.addEventListener('click', addProductItem);

            // Add first product item by default
            addProductItem();

            // Form validation
            document.getElementById('orderForm').addEventListener('submit', function(e) {
                const products = productsList.querySelectorAll('.product-item');
                if (products.length === 0) {
                    e.preventDefault();
                    alert('Please add at least one product to the order.');
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
