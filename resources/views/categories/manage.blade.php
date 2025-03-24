<x-app-layout>
    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
        
        body {
            background-color: #F6F6F6 !important;
            font-family: 'Poppins', sans-serif !important;
        }
        
        .table > :not(caption) > * > * {
            padding: 1rem !important;
            background-color: transparent !important;
            border-bottom-width: 0px !important;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: none !important;
            border-color: #D22254 !important;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .table tr:hover {
            background-color: #f8f9fa;
        }

        .btn:focus {
            box-shadow: none !important;
        }
    </style>
    @endpush

    <div class="container-fluid" style="margin-top:40px">
        <div class="row">
            <div class="col-12">
                <div style="background-color: #ffffff; border-radius: 20px; padding: 2rem; box-shadow: -2.8px -2.8px 8px #ffffffcf,5.9px 6.8px 15.5px #becde247,3.5px 3.5px 6px #ffffff26">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 style="font-family: 'Poppins', sans-serif; font-size: 26px; font-weight: 300; color: #5f5f5f;">Gestion des catégories</h2>
                        
                    </div>

                    <div style="display: flex; justify-content: end; align-items: end; margin: 2rem 0; ">
                        <form action="{{ route('categories.manage') }}" method="GET" class="d-flex gap-3">
                            <input type="text" 
                                   name="search" 
                                   class="form-control" 
                                   style="font-family: 'Poppins', sans-serif; font-size: 14px; height: 44px;width: 325px; border-radius: 8px;"
                                   placeholder="Rechercher une catégorie..."
                                   value="{{ request('search') }}">
                            <select name="lang" class="form-select" style="font-family: 'Poppins', sans-serif; font-size: 14px; height: 44px; border-radius: 8px; width: fit-content;margin-right: 7px;">
                                <option value="fr" {{ request('lang', 'fr') === 'fr' ? 'selected' : '' }}>Fr</option>
                                <option value="en" {{ request('lang') === 'en' ? 'selected' : '' }}>En</option>
                                <option value="it" {{ request('lang') === 'it' ? 'selected' : '' }}>It</option>
                            </select>
                            
                            
                        </form>
                        <a href="{{ route('categories.create') }}" class="btn btn-danger" style="height: 44px;background-color: #D22254; width: 253px !important;">+ NOUVELLE CATÉGORIE</a>

                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="color: #5F5F5F; font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 600; padding: 1rem;">Image</th>
                                    <th style="color: #5F5F5F; font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 600; padding: 1rem;">Nom</th>
                                    <th style="color: #5F5F5F; font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 600; padding: 1rem;">Description</th>
                                    <th style="color: #5F5F5F; font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 600; padding: 1rem;">Produits</th>
                                    <th style="color: #5F5F5F; font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 600; padding: 1rem;">Actions</th>
                                </tr>
                            </thead>
                            <tbody style="font-family: 'Poppins', sans-serif; font-size: 12px; color: #5F5F5F;">
                                @forelse($categories as $category)
                                <tr style="border: 1px solid #E2E8F0; line-height: 3.5; height: 40px;">
                                    <td>
                                        @if($category->image)
                                            <img src="{{ Storage::url($category->image) }}" 
                                                 alt="{{ $category->{"name_" . request('lang', 'fr')} }}"
                                                 style="width: 40px; border-radius: 8px;">
                                        @else
                                        <img src="{{ asset('images/plate.jpg') }}" class="plate-image" width="40" alt="No Image">
                                        @endif
                                    </td>
                                    <td>{{ $category->{"name_" . request('lang', 'fr')} }}</td>
                                    <td>{{ Str::limit($category->description, 50) }}</td>                                    <td>{{ $category->products->count() }}</td>
                                   
                                    <td style="display: flex; gap: 10px; border: none;align-items:center;">
                                        <a href="{{ route('categories.edit', $category) }}" style="border: none; background: none;">
                                        <svg width="13" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.4151 13.8611C15.7384 13.8614 16.0003 14.1165 16 14.431C15.9998 14.7193 15.7793 14.9574 15.4936 14.9949L15.4141 15L9.30706 14.9948C8.98377 14.9945 8.72191 14.7394 8.72218 14.4249C8.72243 14.1366 8.94285 13.8985 9.2286 13.861L9.30804 13.8559L15.4151 13.8611ZM9.4866 0.806899C10.5958 -0.270295 12.3933 -0.26877 13.5007 0.810304L14.6502 1.93054C15.7576 3.00962 15.756 4.75831 14.6469 5.8355L5.99181 14.2409C5.4969 14.7216 4.82624 14.9909 4.12646 14.9903L0.58488 14.9873C0.255879 14.9871 -0.00827646 14.7231 0.000198371 14.4032L0.0922797 10.9268C0.110558 10.2698 0.387464 9.6436 0.86555 9.17931L9.4866 0.806899ZM8.81512 3.06675L1.69269 9.98534C1.42694 10.2434 1.27275 10.5921 1.2626 10.9569L1.18578 13.8485L4.12744 13.8514C4.47358 13.8517 4.80655 13.7335 5.06947 13.5196L5.16467 13.4349L12.3224 6.48368L8.81512 3.06675ZM12.6721 1.61493C12.0216 0.981021 10.9653 0.980125 10.3137 1.61293L9.64426 2.26205L13.1506 5.67897L13.8197 5.02947C14.4351 4.43181 14.4701 3.48204 13.9241 2.84433L13.8217 2.73517L12.6721 1.61493Z" fill="#5F5F5F"/>
</svg>

                                        </a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button  type="submit" onclick="return confirm('Are you sure?')" style="border: none; background: none;">
                                            <svg  width="13" height="12" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.4682 5.03896L11.54 5.03997C11.8066 5.06285 12.0109 5.29269 12.0251 5.56936L12.0182 5.72363L11.7912 8.61206L11.553 11.4308C11.5026 11.9936 11.4575 12.4682 11.4186 12.8418C11.2833 14.1439 10.4694 14.9491 9.24241 14.973C7.33052 15.0097 5.49275 15.0094 3.70811 14.9694C2.51662 14.9435 1.7147 14.1296 1.58168 12.8475L1.48975 11.9028L1.32909 10.0705L1.16451 8.05978L0.976329 5.64615C0.95294 5.33648 1.16971 5.06526 1.46051 5.04035C1.72706 5.01752 1.96329 5.20959 2.01883 5.48029L2.04045 5.7015L2.21715 7.96423L2.41008 10.3096C2.49662 11.3249 2.57167 12.1466 2.63173 12.7237C2.70753 13.4544 3.07804 13.8304 3.73002 13.8446C5.50072 13.8843 7.32478 13.8846 9.22323 13.8481C9.91483 13.8347 10.2912 13.4623 10.3686 12.7179L10.46 11.7783C10.4868 11.4887 10.5154 11.1691 10.5457 10.8218L10.7387 8.51521L10.9711 5.55549C10.9926 5.27163 11.2084 5.05403 11.4682 5.03896ZM0.528246 3.74216C0.236515 3.74217 1.10385e-05 3.49033 3.86923e-10 3.17966C-1.01179e-05 2.89488 0.198703 2.65952 0.456529 2.62226L0.528206 2.61712L2.82944 2.61703C3.10291 2.61702 3.34231 2.42963 3.42793 2.15963L3.44888 2.07626L3.62768 1.12916C3.78515 0.501884 4.29653 0.0552612 4.89583 0.00486717L5.00916 0.000114231L7.99047 9.96265e-10C8.59972 -2.33424e-05 9.1377 0.409661 9.34482 1.04273L9.37972 1.16401L9.55085 2.07581C9.60458 2.36147 9.82402 2.57482 10.0895 2.61124L10.1704 2.61675L12.4718 2.61666C12.7635 2.61665 13 2.86849 13 3.17916C13 3.46394 12.8013 3.69931 12.5435 3.73656L12.4718 3.7417L0.528246 3.74216ZM7.99051 1.12504L5.0092 1.12515C4.86099 1.12516 4.72925 1.21754 4.67453 1.33364L4.65598 1.38465L4.48482 2.29691C4.46389 2.40826 4.43355 2.51548 4.39479 2.61771L8.60511 2.6177C8.58092 2.55391 8.56 2.48819 8.54259 2.42073L8.51493 2.29653L8.35144 1.41958C8.31323 1.26742 8.19524 1.15602 8.05286 1.13056L7.99051 1.12504Z" fill="#5F5F5F"/>
</svg>

                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4" style="font-family: 'Poppins', sans-serif;">
                                        Aucune catégorie trouvée
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

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
</x-app-layout>