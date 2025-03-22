<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Ingredient') }}
            </h2>
            <a href="{{ route('ingredients.index') }}" class="btn btn-secondary">
                Back to Ingredients
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <form action="{{ route('ingredients.update', $ingredient) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Basic Information -->
                            <div class="space-y-4">
                                <div>
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" 
                                           name="name" 
                                           id="name" 
                                           value="{{ old('name', $ingredient->name) }}" 
                                           class="form-control w-full @error('name') is-invalid @enderror" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="unit" class="form-label">Unit of Measurement</label>
                                    <select name="unit" 
                                            id="unit" 
                                            class="form-select w-full @error('unit') is-invalid @enderror" 
                                            required>
                                        <option value="">Select Unit</option>
                                        <option value="g" {{ old('unit', $ingredient->unit) == 'g' ? 'selected' : '' }}>Grams (g)</option>
                                        <option value="kg" {{ old('unit', $ingredient->unit) == 'kg' ? 'selected' : '' }}>Kilograms (kg)</option>
                                        <option value="ml" {{ old('unit', $ingredient->unit) == 'ml' ? 'selected' : '' }}>Milliliters (ml)</option>
                                        <option value="l" {{ old('unit', $ingredient->unit) == 'l' ? 'selected' : '' }}>Liters (l)</option>
                                        <option value="pcs" {{ old('unit', $ingredient->unit) == 'pcs' ? 'selected' : '' }}>Pieces (pcs)</option>
                                        <option value="oz" {{ old('unit', $ingredient->unit) == 'oz' ? 'selected' : '' }}>Ounces (oz)</option>
                                    </select>
                                    @error('unit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="cost_per_unit" class="form-label">Cost per Unit</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-2">$</span>
                                        <input type="number" 
                                               name="cost_per_unit" 
                                               id="cost_per_unit" 
                                               value="{{ old('cost_per_unit', $ingredient->cost_per_unit) }}" 
                                               step="0.01" 
                                               class="form-control w-full pl-8 @error('cost_per_unit') is-invalid @enderror" 
                                               required>
                                    </div>
                                    @error('cost_per_unit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" 
                                           name="stock" 
                                           id="stock" 
                                           value="{{ old('stock', $ingredient->stock) }}" 
                                           class="form-control w-full @error('stock') is-invalid @enderror" 
                                           required>
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Additional Information -->
                            <div class="space-y-4">
                                <div>
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" 
                                              id="description" 
                                              rows="4" 
                                              class="form-control w-full @error('description') is-invalid @enderror">{{ old('description', $ingredient->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="active" class="form-label">Status</label>
                                    <select name="active" 
                                            id="active" 
                                            class="form-select w-full @error('active') is-invalid @enderror">
                                        <option value="1" {{ old('active', $ingredient->active) ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('active', $ingredient->active) ? '' : 'selected' }}>Inactive</option>
                                    </select>
                                    @error('active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="btn btn-primary">
                                Update Ingredient
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
