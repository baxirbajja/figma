<x-app-layout>
    @push('styles')
    <style>
        body {
            background-color: #F6F6F6;
            font-family: 'Poppins', sans-serif;
        }

        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: #FFFFFF;
            border-bottom: 1px solid #E7E7E7;
            padding: 1.25rem 1.5rem;
            border-radius: 0.75rem 0.75rem 0 0;
        }

        .card-header h5 {
            color: #2D3748;
            font-weight: 600;
            font-size: 1rem;
        }

        .card-body {
            padding: 1.5rem;
            background: #FFFFFF;
        }

        .form-label {
            color: #4A5568;
            font-weight: 500;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 1px solid #E2E8F0;
            border-radius: 0.5rem;
            padding: 0.625rem 0.75rem;
            font-size: 0.875rem;
            color: #2D3748;
        }

        .form-control:focus {
            border-color: #D22254;
            box-shadow: none;
        }

        .btn-primary {
            background: #D22254;
            border-color: #D22254;
            border-radius: 0.5rem;
            padding: 0.625rem 1rem;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .btn-primary:hover {
            background: #BB1E4A;
            border-color: #BB1E4A;
        }

        .btn-secondary {
            background: #EDF2F7;
            border-color: #EDF2F7;
            color: #4A5568;
            border-radius: 0.5rem;
            padding: 0.625rem 1rem;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .btn-secondary:hover {
            background: #E2E8F0;
            border-color: #E2E8F0;
            color: #2D3748;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background: #FFFFFF;
            color: #4A5568;
            font-weight: 500;
            font-size: 0.875rem;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #E2E8F0;
        }

        .table td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
            color: #2D3748;
            font-size: 0.875rem;
            border-bottom: 1px solid #E2E8F0;
        }

        .btn-link {
            color: #718096;
            padding: 0;
            margin-right: 1rem;
            text-decoration: none;
        }

        .btn-link:hover {
            color: #D22254;
        }

        .modal-content {
            border: none;
            border-radius: 0.75rem;
        }

        .modal-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #E2E8F0;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            padding: 1.25rem 1.5rem;
            border-top: 1px solid #E2E8F0;
        }

        .invalid-feedback {
            color: #D22254;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }
    </style>
    @endpush

    <div class="container-fluid" style="background-color: #ffffff;margin-top:40px;  border-radius: 20px;padding: 2rem;box-shadow: -2.8px -2.8px 8px #ffffffcf,5.9px 6.8px 15.5px #becde247,3.5px 3.5px 6px #ffffff26">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="text-xl">Gestion des codes promo</h1>
                <p class="text-gray-600">Gérer les codes promo de vos produits</p>
            </div>
        </div>
        <div class="row">
            <!-- Left Column - Add Form -->
            <div class="col-md-4 " style="max-width: fit-content !important;padding: 2rem;">
            <div class="bg-white rounded-lg shadow-sm p-4">
                    <h2 class="h5 mb-4">Ajouter un code promo</h2>
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
                                <button style="background-color: #D22254; width:248px !important;" type="submit" class="btn btn-danger w-100    ">
                                    Ajouter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Column - List -->
            <div class="col-md-8">
            <div class="bg-white rounded-lg ">
            <div class="p-4 border-bottom">
                        <form action="{{ route('promo-codes.index') }}" method="GET" class="d-flex gap-2" style="justify-content: end;">
                            <input type="text" 
                                   name="search" 
                                   class="form-control"
                                   style="width: 263px;" 
                                   placeholder="Rechercher un code promo..."
                                   value="{{ request('search') }}">
                            <button type="submit" >
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                    </div>
            </div>
                    <div class="table-responsive">
                        <table class="table">
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
                                        <button  data-bs-toggle="modal" 
                                                data-bs-target="#editPromoCode{{ $code->id }}">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.4151 14.7852C15.7384 14.7855 16.0003 15.0576 16 15.3931C15.9998 15.7006 15.7793 15.9546 15.4936 15.9945L15.4141 16L9.30706 15.9945C8.98377 15.9942 8.72191 15.722 8.72218 15.3865C8.72243 15.079 8.94285 14.8251 9.2286 14.7851L9.30804 14.7796L15.4151 14.7852ZM9.4866 0.860692C10.5958 -0.288315 12.3933 -0.286688 13.5007 0.864325L14.6502 2.05924C15.7576 3.21026 15.756 5.07553 14.6469 6.22454L5.99181 15.1903C5.4969 15.703 4.82624 15.9903 4.12646 15.9897L0.58488 15.9865C0.255879 15.9862 -0.00827646 15.7047 0.000198371 15.3634L0.0922797 11.6553C0.110558 10.9544 0.387464 10.2865 0.86555 9.79126L9.4866 0.860692ZM8.81512 3.2712L1.69269 10.651C1.42694 10.9263 1.27275 11.2982 1.2626 11.6874L1.18578 14.7718L4.12744 14.7748C4.47358 14.7752 4.80655 14.649 5.06947 14.4209L5.16467 14.3306L12.3224 6.91592L8.81512 3.2712ZM12.6721 1.7226C12.0216 1.04642 10.9653 1.04547 10.3137 1.72046L9.64426 2.41285L13.1506 6.05757L13.8197 5.36476C14.4351 4.72727 14.4701 3.71418 13.9241 3.03396L13.8217 2.91752L12.6721 1.7226Z" fill="#5F5F5F"/>
</svg>
                                        </button>
                                        <form action="{{ route('promo-codes.destroy', $code) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('Êtes-vous sûr ?')">
                                                    <svg width="13" height="16" viewBox="0 0 13 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.4682 5.37489L11.54 5.37597C11.8066 5.40037 12.0109 5.64554 12.0251 5.94065L12.0182 6.1052L11.7912 9.18619L11.553 12.1929C11.5026 12.7931 11.4575 13.2994 11.4186 13.6979C11.2833 15.0868 10.4694 15.9457 9.24241 15.9712C7.33052 16.0104 5.49275 16.0101 3.70811 15.9674C2.51662 15.9397 1.7147 15.0716 1.58168 13.704L1.48975 12.6963L1.32909 10.7419L1.16451 8.5971L0.976329 6.02256C0.95294 5.69225 1.16971 5.40294 1.46051 5.37637C1.72706 5.35202 1.96329 5.5569 2.01883 5.84564L2.04045 6.0816L2.21715 8.49518L2.41008 10.9969C2.49662 12.0799 2.57167 12.9563 2.63173 13.572C2.70753 14.3514 3.07804 14.7525 3.73002 14.7676C5.50072 14.8099 7.32478 14.8103 9.22323 14.7713C9.91483 14.757 10.2912 14.3598 10.3686 13.5657L10.46 12.5635C10.4868 12.2547 10.5154 11.9137 10.5457 11.5433L10.7387 9.08289L10.9711 5.92586C10.9926 5.62307 11.2084 5.39097 11.4682 5.37489ZM0.528246 3.99164C0.236515 3.99165 1.10385e-05 3.72302 3.86923e-10 3.39164C-1.01179e-05 3.08787 0.198703 2.83682 0.456529 2.79708L0.528206 2.7916L2.82944 2.7915C3.10291 2.79149 3.34231 2.5916 3.42793 2.30361L3.44888 2.21468L3.62768 1.20443C3.78515 0.535342 4.29653 0.0589452 4.89583 0.00519165L5.00916 0.000121846L7.99047 1.06268e-09C8.59972 -2.48986e-05 9.1377 0.436971 9.34482 1.11225L9.37972 1.24161L9.55085 2.21419C9.60458 2.5189 9.82402 2.74647 10.0895 2.78532L10.1704 2.7912L12.4718 2.79111C12.7635 2.7911 13 3.05972 13 3.39111C13 3.69487 12.8013 3.94593 12.5435 3.98567L12.4718 3.99115L0.528246 3.99164ZM7.99051 1.20004L5.0092 1.20016C4.86099 1.20017 4.72925 1.29871 4.67453 1.42255L4.65598 1.47696L4.48482 2.45004C4.46389 2.56881 4.43355 2.68318 4.39479 2.79223L8.60511 2.79221C8.58092 2.72418 8.56 2.65407 8.54259 2.58211L8.51493 2.44964L8.35144 1.51422C8.31323 1.35191 8.19524 1.23309 8.05286 1.20593L7.99051 1.20004Z" fill="#5F5F5F"/>
</svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editPromoCode{{ $code->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Modifier le code promo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('promo-codes.update', $code) }}" method="POST">
                                                @csrf
                                                @method('PUT')
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
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>