<x-app-layout>
    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <!-- <style>
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







        .active {
            color:#D22254 !important;
        }
    </style> -->
    @endpush

    <!-- Include the sidebar -->
    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }
        input{
            width: 248px !important;height: 44px;border-radius: 4px;box-shadow: inset 0px 2px 5px rgba(0, 0, 0, 0.1);border: none
        }
        .nav li .active {
            color:#D22254 !important;
            border-bottom: 3px solid #D22254;
        }
        .nav-link{
            color:#5E5E5E ;
        }
        .nav-link:hover{
            color:#D22254!important;
        }
        .nav{
            margin-top:40px;
            border-bottom: 2px solid #E2E8F0;
        }
        .table-item{
border: 1px solid #E2E8F0;
margin-bottom: 1rem;
}
        thead th {
            color:#5F5F5F;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 600;
            padding: 1rem;
            background-color: #FFF !important;
        }
        
        tbody {
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            color:#5F5F5F;
        }
        .plate-image{
            width: 50px;
            height: 50px;
            object-fit: cover;
            
            border-radius: 40%;
        }
        tbody svg{
            width: 20px;
            margin: 0px 1px;
        }
        
        
        
        </style>
    <div class="main-content ">
        <div class="content">
            <div class="container-fluid px-4" style="background-color: #ffffff;border-radius: 20px;padding: 2rem;box-shadow: -2.8px -2.8px 8px #ffffffcf,5.9px 6.8px 15.5px #becde247,3.5px 3.5px 6px #ffffff26">
                <h2 class="mb-3" style="padding-bottom: 2rem; font-family: 'Poppins', sans-serif;font-size: 26px;font-weight: 300;color: #5f5f5f;">Gestion des Produits</h2>
                
                <!-- Search & Button -->
                <div style="display: flex; justify-content: end; align-items: end; margin-top: 2rem; ">
                    <form action="{{ route('products.index') }}" method="GET" class="d-flex align-items-center">
                        <input type="text" name="search" class="form-control w-100" style="width: 248px !important;height: 44px;border-radius: 4px;box-shadow: inset 0px 2px 5px rgba(0, 0, 0, 0.1);border: none;" 
                               placeholder="Recherche" value="{{ request('search') }}">
                        <select name="language" class="form-select ms-2" style="width: fit-content !important;height: 44px;border-radius: 4px;box-shadow: inset 0px 2px 5px rgba(0, 0, 0, 0.1);border: none;margin-right: 7px;">
                            <option value="fr" {{ request('language', 'fr') == 'fr' ? 'selected' : '' }}>Fr</option>
                            <option value="en" {{ request('language') == 'en' ? 'selected' : '' }}>En</option>
                            <option value="it" {{ request('language') == 'it' ? 'selected' : '' }}>It</option>
                        </select>
                    </form>
                    <a href="{{ route('products.create') }}" class="btn btn-danger" style="height: 44px;background-color: #D22254; width: 253px;">+ NOUVEAU PRODUIT</a>
                </div>

                <!-- Tabs -->
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link {{ !request('category') ? 'active' : '' }}" 
                           href="{{ route('products.index', ['search' => request('search'), 'language' => request('language')]) }}">
                            Tous
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <li class="nav-item">
                            <a style class="nav-link {{ request('category') == $category->id ? 'active' : '' }}" 
                               href="{{ route('products.index', ['category' => $category->id, 'search' => request('search'), 'language' => request('language')]) }}">
                                {{ $category->{"name_" . (request('language', 'fr'))} }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <!-- Product Table -->
                <table class="table  mt-3">
                    <thead class="bg-light">
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Emporter</th>
                            <th>Livraison</th>
                            <th>Catégorie</th>
                            <th>Ingrédients</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr class="table-item">
                                
                                <td >
                                    @if($product->image_path)
                                        <img src="{{ Storage::url($product->image_path) }}" class="plate-image" alt="{{ $product->name }}" width="50">
                                    @else
                                        <img src="{{ asset('images/plate.jpg') }}" class="plate-image" width="50" alt="No Image">
                                    @endif
                                </td>
                                <td>{{ $product->{"name_" . request('language', 'fr')} }}</td>
                                <td>{{ Str::limit($product->description, 50) }}</td>
                                <td>{{ number_format($product->price, 2) }}€</td>
                                <td>{{ number_format($product->delivery_price, 2) }}€</td>
                                <td>{{ $product->category->{"name_" . request('language', 'fr')} }}</td>
                                <td>
                                    @foreach($product->ingredients as $ingredient)
                                        <span class="badge bg-secondary" style="background-color: #F6F6F6 !important;color:#5F5F5F ;font-family: 'Poppins', sans-serif;font-size: 12px;font-weight: 400 ;">{{ $ingredient->{"name_" . request('language', 'fr')} }} x</span>
                                    @endforeach
                                </td>
                                <td style="display: flex; border:none;">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M3.25 6.25L1 8.5M1 8.5L3.25 10.75M1 8.5H16M6.25 3.25L8.5 1M8.5 1L10.75 3.25M8.5 1V16M10.75 13.75L8.5 16M8.5 16L6.25 13.75M13.75 6.25L16 8.5M16 8.5L13.75 10.75" stroke="#5F5F5F" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

                                    <a href="{{ route('products.edit', $product->id) }}" ><svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.4151 13.8611C15.7384 13.8614 16.0003 14.1165 16 14.431C15.9998 14.7193 15.7793 14.9574 15.4936 14.9949L15.4141 15L9.30706 14.9948C8.98377 14.9945 8.72191 14.7394 8.72218 14.4249C8.72243 14.1366 8.94285 13.8985 9.2286 13.861L9.30804 13.8559L15.4151 13.8611ZM9.4866 0.806899C10.5958 -0.270295 12.3933 -0.26877 13.5007 0.810304L14.6502 1.93054C15.7576 3.00962 15.756 4.75831 14.6469 5.8355L5.99181 14.2409C5.4969 14.7216 4.82624 14.9909 4.12646 14.9903L0.58488 14.9873C0.255879 14.9871 -0.00827646 14.7231 0.000198371 14.4032L0.0922797 10.9268C0.110558 10.2698 0.387464 9.6436 0.86555 9.17931L9.4866 0.806899ZM8.81512 3.06675L1.69269 9.98534C1.42694 10.2434 1.27275 10.5921 1.2626 10.9569L1.18578 13.8485L4.12744 13.8514C4.47358 13.8517 4.80655 13.7335 5.06947 13.5196L5.16467 13.4349L12.3224 6.48368L8.81512 3.06675ZM12.6721 1.61493C12.0216 0.981021 10.9653 0.980125 10.3137 1.61293L9.64426 2.26205L13.1506 5.67897L13.8197 5.02947C14.4351 4.43181 14.4701 3.48204 13.9241 2.84433L13.8217 2.73517L12.6721 1.61493Z" fill="#5F5F5F"/>
</svg>

</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')"><svg width="13" height="16" viewBox="0 0 13 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.4682 5.37489L11.54 5.37597C11.8066 5.40037 12.0109 5.64554 12.0251 5.94065L12.0182 6.1052L11.7912 9.18619L11.553 12.1929C11.5026 12.7931 11.4575 13.2994 11.4186 13.6979C11.2833 15.0868 10.4694 15.9457 9.24241 15.9712C7.33052 16.0104 5.49275 16.0101 3.70811 15.9674C2.51662 15.9397 1.7147 15.0716 1.58168 13.704L1.48975 12.6963L1.32909 10.7419L1.16451 8.5971L0.976329 6.02256C0.95294 5.69225 1.16971 5.40294 1.46051 5.37637C1.72706 5.35202 1.96329 5.5569 2.01883 5.84564L2.04045 6.0816L2.21715 8.49518L2.41008 10.9969C2.49662 12.0799 2.57167 12.9563 2.63173 13.572C2.70753 14.3514 3.07804 14.7525 3.73002 14.7676C5.50072 14.8099 7.32478 14.8103 9.22323 14.7713C9.91483 14.757 10.2912 14.3598 10.3686 13.5657L10.46 12.5635C10.4868 12.2547 10.5154 11.9137 10.5457 11.5433L10.7387 9.08289L10.9711 5.92586C10.9926 5.62307 11.2084 5.39097 11.4682 5.37489ZM0.528246 3.99164C0.236515 3.99165 1.10385e-05 3.72302 3.86923e-10 3.39164C-1.01179e-05 3.08787 0.198703 2.83682 0.456529 2.79708L0.528206 2.7916L2.82944 2.7915C3.10291 2.79149 3.34231 2.5916 3.42793 2.30361L3.44888 2.21468L3.62768 1.20443C3.78515 0.535342 4.29653 0.0589452 4.89583 0.00519165L5.00916 0.000121846L7.99047 1.06268e-09C8.59972 -2.48986e-05 9.1377 0.436971 9.34482 1.11225L9.37972 1.24161L9.55085 2.21419C9.60458 2.5189 9.82402 2.74647 10.0895 2.78532L10.1704 2.7912L12.4718 2.79111C12.7635 2.7911 13 3.05972 13 3.39111C13 3.69487 12.8013 3.94593 12.5435 3.98567L12.4718 3.99115L0.528246 3.99164ZM7.99051 1.20004L5.0092 1.20016C4.86099 1.20017 4.72925 1.29871 4.67453 1.42255L4.65598 1.47696L4.48482 2.45004C4.46389 2.56881 4.43355 2.68318 4.39479 2.79223L8.60511 2.79221C8.58092 2.72418 8.56 2.65407 8.54259 2.58211L8.51493 2.44964L8.35144 1.51422C8.31323 1.35191 8.19524 1.23309 8.05286 1.20593L7.99051 1.20004Z" fill="#5F5F5F"/>
</svg>

</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
</x-app-layout>
