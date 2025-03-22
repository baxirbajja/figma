<x-app-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="text-xl mb-2">Modifier la commande {{ $order->order_number }}</h1>
                <p class="text-gray-600">Modifier les détails de la commande</p>
            </div>
            <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-secondary">
                Retour aux détails
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-4">
            <form action="{{ route('orders.update', $order) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Order Status -->
                <div class="mb-4">
                    <label for="status" class="form-label">Statut</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>En cours</option>
                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Terminée</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Annulée</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Order Items (Read-only) -->
                <div class="mb-4">
                    <h2 class="text-lg mb-3">Produits commandés</h2>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th class="text-center">Quantité</th>
                                    <th class="text-end">Prix unitaire</th>
                                    <th class="text-end">Sous-total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end">{{ number_format($item->unit_price, 2) }} €</td>
                                        <td class="text-end">{{ number_format($item->subtotal, 2) }} €</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Total</strong></td>
                                    <td class="text-end"><strong>{{ number_format($order->total_amount, 2) }} €</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Notes -->
                <div class="mb-4">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror" 
                              rows="3">{{ old('notes', $order->notes) }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        METTRE À JOUR
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
