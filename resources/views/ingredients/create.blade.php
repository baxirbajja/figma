<x-app-layout>
    <div class="container-fluid">
        <h1 class="text-xl mb-4">Nouveau ingrédient</h1>
        <p class="text-gray-600 mb-6">Veuillez sélectionner un thèmes pour votre site</p>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <form action="{{ route('ingredients.store') }}" method="POST">
                @csrf

                <!-- Name Fields -->
                <div class="mb-4">
                    <label class="form-label">Nom</label>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">Fr</span>
                                <input type="text" 
                                       name="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name') }}" 
                                       required>
                            </div>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">En</span>
                                <input type="text" 
                                       name="name_en" 
                                       class="form-control @error('name_en') is-invalid @enderror" 
                                       value="{{ old('name_en') }}">
                            </div>
                            @error('name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">Nl</span>
                                <input type="text" 
                                       name="name_nl" 
                                       class="form-control @error('name_nl') is-invalid @enderror" 
                                       value="{{ old('name_nl') }}">
                            </div>
                            @error('name_nl')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Description Fields -->
                <div class="mb-4">
                    <label class="form-label">Description</label>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">Fr</span>
                                <input type="text" 
                                       name="description" 
                                       class="form-control @error('description') is-invalid @enderror" 
                                       value="{{ old('description') }}">
                            </div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">En</span>
                                <input type="text" 
                                       name="description_en" 
                                       class="form-control @error('description_en') is-invalid @enderror" 
                                       value="{{ old('description_en') }}">
                            </div>
                            @error('description_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">Nl</span>
                                <input type="text" 
                                       name="description_nl" 
                                       class="form-control @error('description_nl') is-invalid @enderror" 
                                       value="{{ old('description_nl') }}">
                            </div>
                            @error('description_nl')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        AJOUTER
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
