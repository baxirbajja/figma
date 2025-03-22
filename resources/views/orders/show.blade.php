<x-app-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="text-xl mb-2">Commande {{ $order->order_number }}</h1>
                <p class="text-gray-600">Créée le {{ $order->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('orders.edit', $order) }}" class="btn btn-secondary">
                    <i class="fas fa-pencil-alt me-2"></i> Modifier
                </a>
                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
                    Retour à la liste
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Order Details -->
            <div class="col-md-4 mb-4">
                <div class="bg-white rounded-lg shadow-sm p-4">
                    <h2 class="text-lg mb-3">Détails de la commande</h2>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Client</dt>
                        <dd class="col-sm-8">{{ $order->user->name }}</dd>

                        <dt class="col-sm-4">Statut</dt>
                        <dd class="col-sm-8">
                            <span class="badge bg-{{ $order->status === 'completed' ? 'success' : 
                                ($order->status === 'cancelled' ? 'danger' : 
                                ($order->status === 'processing' ? 'warning' : 'info')) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </dd>

                        <dt class="col-sm-4">Total</dt>
                        <dd class="col-sm-8">{{ number_format($order->total_amount, 2) }} €</dd>

                        @if($order->notes)
                            <dt class="col-sm-4">Notes</dt>
                            <dd class="col-sm-8">{{ $order->notes }}</dd>
                        @endif
                    </dl>
                </div>
            </div>

            <!-- Order Items -->
            <div class="col-md-8">
                <div class="bg-white rounded-lg shadow-sm">
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
            </div>
        </div>
    </div>
</x-app-layout>
