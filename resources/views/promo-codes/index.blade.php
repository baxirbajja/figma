<x-app-layout>
    <div class="container-fluid" style="padding:40px">
        <div class="row">
            <!-- Left Column - Add Form -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Ajouter un code promo</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('promo-codes.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Référence</label>
                                <input type="text" name="reference" class="form-control @error('reference') is-invalid @enderror" 
                                       value="{{ old('reference') }}" required>
                                @error('reference')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Code</label>
                                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" 
                                       value="{{ old('code') }}" required>
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-2"></i>Ajouter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Column - List -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Liste des codes promo</h5>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Rechercher..." 
                                       wire:model.debounce.300ms="search">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Référence</th>
                                    <th>Code</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($promoCodes as $code)
                                <tr>
                                    <td>{{ $code->reference }}</td>
                                    <td>{{ $code->code }}</td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" 
                                                data-bs-target="#editPromoCode{{ $code->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="{{ route('promo-codes.destroy', $code) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Êtes-vous sûr ?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editPromoCode{{ $code->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('promo-codes.update', $code) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Modifier le code promo</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Référence</label>
                                                        <input type="text" name="reference" class="form-control" 
                                                               value="{{ $code->reference }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Code</label>
                                                        <input type="text" name="code" class="form-control" 
                                                               value="{{ $code->code }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">
                                        Aucun code promo trouvé
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="p-4">
                        {{ $promoCodes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>