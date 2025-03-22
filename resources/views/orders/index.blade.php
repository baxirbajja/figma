<x-app-layout>
    <div class="container-fluid">
        <h1 class="text-xl mb-4">Gestion des commandes</h1>
        <p class="text-gray-600 mb-6">Liste des commandes</p>

        <!-- Top Bar -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="input-group" style="max-width: 300px;">
                <input type="text" class="form-control" placeholder="Recherche">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <a href="{{ route('orders.create') }}" class="btn btn-primary">
                + NOUVELLE COMMANDE
            </a>
        </div>

        <!-- Orders Table -->
        <div class="bg-white rounded-lg shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover">
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
                        @forelse ($orders as $order)
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
                                <div class="d-flex gap-2">
                                    <a href="{{ route('orders.show', $order) }}" 
                                       class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('orders.edit', $order) }}" 
                                       class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('orders.destroy', $order) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this order?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    Aucune commande trouvée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center py-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
