<x-app-layout>
    <div class="container-fluid" style="margin-top:40px">
        <div class="row">
            <div class="col-12">
                <div style="background-color: #ffffff;border-radius: 20px;padding: 2rem;box-shadow: -2.8px -2.8px 8px #ffffffcf,5.9px 6.8px 15.5px #becde247,3.5px 3.5px 6px #ffffff26">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 style="font-family: 'Poppins', sans-serif;font-size: 26px;font-weight: 300;color: #5f5f5f;">Gestion des catégories</h2>
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addCategoryModal" style="background-color: #D22254; color: white; width: 248px; height: 44px;">
                            Ajouter une catégorie
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="color: #5F5F5F; font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 600; padding: 1rem;">Ordre</th>
                                    <th style="color: #5F5F5F; font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 600; padding: 1rem;">Icône</th>
                                    <th style="color: #5F5F5F; font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 600; padding: 1rem;">Nom</th>
                                    <th style="color: #5F5F5F; font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 600; padding: 1rem;">Produits</th>
                                    <th style="color: #5F5F5F; font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 600; padding: 1rem;">Statut</th>
                                    <th style="color: #5F5F5F; font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 600; padding: 1rem;">Actions</th>
                                </tr>
                            </thead>
                            <tbody style="font-family: 'Poppins', sans-serif; font-size: 12px; color: #5F5F5F;">
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->sort_order }}</td>
                                    <td><i class="bi {{ $category->icon }}"></i></td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->products->count() }}</td>
                                    <td>
                                        @if($category->is_active)
                                            <span class="badge" style="background-color: #F6F6F6; color: #5F5F5F; font-family: 'Poppins', sans-serif; font-size: 12px; font-weight: 400;">Actif</span>
                                        @else
                                            <span class="badge" style="background-color: #F6F6F6; color: #5F5F5F; font-family: 'Poppins', sans-serif; font-size: 12px; font-weight: 400;">Inactif</span>
                                        @endif
                                    </td>
                                    <td style="display: flex; gap: 10px; border: none;">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#editCategory{{ $category->id }}" style="border: none; background: none;">
                                            <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.4151 13.8611C15.7384 13.8614 16.0003 14.1165 16 14.431C15.9998 14.7193 15.7793 14.9574 15.4936 14.9949L15.4141 15L9.30706 14.9948C8.98377 14.9945 8.72191 14.7394 8.72218 14.4249C8.72243 14.1366 8.94285 13.8985 9.2286 13.861L9.30804 13.8559L15.4151 13.8611ZM9.4866 0.806899C10.5958 -0.270295 12.3933 -0.26877 13.5007 0.810304L14.6502 1.93054C15.7576 3.00962 15.756 4.75831 14.6469 5.8355L5.99181 14.2409C5.4969 14.7216 4.82624 14.9909 4.12646 14.9903L0.58488 14.9873C0.255879 14.9871 -0.00827646 14.7231 0.000198371 14.4032L0.0922797 10.9268C0.110558 10.2698 0.387464 9.6436 0.86555 9.17931L9.4866 0.806899Z" fill="#5F5F5F"/>
                                            </svg>
                                        </button>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')" style="border: none; background: none;">
                                                <svg width="13" height="16" viewBox="0 0 13 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.4682 5.37489L11.54 5.37597C11.8066 5.40037 12.0109 5.64554 12.0251 5.94065L12.0182 6.1052L11.7912 9.18619L11.553 12.1929C11.5026 12.7931 11.4575 13.2994 11.4186 13.6979C11.2833 15.0868 10.4694 15.9457 9.24241 15.9712C7.33052 16.0104 5.49275 16.0101 3.70811 15.9674C2.51662 15.9397 1.7147 15.0716 1.58168 13.704L1.48975 12.6963L1.32909 10.7419L1.16451 8.5971L0.976329 6.02256C0.95294 5.69225 1.16971 5.40294 1.46051 5.37637C1.72706 5.35202 1.96329 5.5569 2.01883 5.84564L2.04045 6.0816L2.21715 8.49518L2.41008 10.9969C2.49662 12.0799 2.57167 12.9563 2.63173 13.572C2.70753 14.3514 3.07804 14.7525 3.73002 14.7676C5.50072 14.8099 7.32478 14.8103 9.22323 14.7713C9.91483 14.757 10.2912 14.3598 10.3686 13.5657L10.46 12.5635C10.4868 12.2547 10.5154 11.9137 10.5457 11.5433L10.7387 9.08289L10.9711 5.92586C10.9926 5.62307 11.2084 5.39097 11.4682 5.37489Z" fill="#5F5F5F"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include your existing modals here -->

    @push('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
        
        body {
            background-color: #F6F6F6;
        }
        
        .table > :not(caption) > * > * {
            padding: 1rem;
            background-color: transparent;
            border-bottom-width: 0px;
        }
        
        .btn:focus, .btn:active {
            outline: none !important;
            box-shadow: none !important;
        }
        
        button {
            background: none;
            border: none;
            padding: 0;
        }
        
        svg {
            width: 20px !important;
            height: 20px !important;
            margin: 0px 5px !important;
        }
    </style>
    @endpush
</x-app-layout>