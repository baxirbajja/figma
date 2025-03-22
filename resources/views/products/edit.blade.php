<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Product') }}
            </h2>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                Back to Products
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
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
                                           value="{{ old('name', $product->name) }}" 
                                           class="form-control w-full @error('name') is-invalid @enderror" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="sku" class="form-label">SKU</label>
                                    <input type="text" 
                                           name="sku" 
                                           id="sku" 
                                           value="{{ old('sku', $product->sku) }}" 
                                           class="form-control w-full @error('sku') is-invalid @enderror" 
                                           required>
                                    @error('sku')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" 
                                           name="price" 
                                           id="price" 
                                           value="{{ old('price', $product->price) }}" 
                                           step="0.01" 
                                           class="form-control w-full @error('price') is-invalid @enderror" 
                                           required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" 
                                           name="stock" 
                                           id="stock" 
                                           value="{{ old('stock', $product->stock) }}" 
                                           class="form-control w-full @error('stock') is-invalid @enderror" 
                                           required>
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="active" class="form-label">Status</label>
                                    <select name="active" 
                                            id="active" 
                                            class="form-select w-full @error('active') is-invalid @enderror">
                                        <option value="1" {{ old('active', $product->active) ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('active', $product->active) ? '' : 'selected' }}>Inactive</option>
                                    </select>
                                    @error('active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="image" class="form-label">Product Image</label>
                                    @if ($product->image_path)
                                        <div class="mb-2">
                                            <img src="{{ Storage::url($product->image_path) }}" 
                                                 alt="{{ $product->name }}"
                                                 class="w-32 h-32 object-cover rounded">
                                        </div>
                                    @endif
                                    <input type="file" 
                                           name="image" 
                                           id="image" 
                                           class="form-control w-full @error('image') is-invalid @enderror"
                                           accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Description and Ingredients -->
                            <div class="space-y-4">
                                <div>
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" 
                                              id="description" 
                                              rows="4" 
                                              class="form-control w-full @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div x-data="{ ingredients: {{ json_encode($product->ingredients->map(fn($i) => [
                                    'id' => $i->id,
                                    'quantity' => $i->pivot->quantity,
                                    'unit' => $i->pivot->unit
                                ])) }} }">
                                    <label class="form-label">Ingredients</label>
                                    <div class="space-y-2" id="ingredients-container">
                                        <template x-for="(ingredient, index) in ingredients" :key="index">
                                            <div class="flex gap-2">
                                                <select :name="'ingredients['+index+'][id]'" 
                                                        class="form-select flex-1" 
                                                        required
                                                        x-model="ingredient.id">
                                                    <option value="">Select Ingredient</option>
                                                    @foreach($ingredients as $ing)
                                                        <option value="{{ $ing->id }}">
                                                            {{ $ing->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <input type="number" 
                                                       :name="'ingredients['+index+'][quantity]'" 
                                                       placeholder="Quantity"
                                                       class="form-control w-24" 
                                                       required
                                                       x-model="ingredient.quantity">
                                                <input type="text" 
                                                       :name="'ingredients['+index+'][unit]'" 
                                                       placeholder="Unit"
                                                       class="form-control w-24" 
                                                       required
                                                       x-model="ingredient.unit">
                                                <button type="button" 
                                                        @click="ingredients.splice(index, 1)" 
                                                        class="btn btn-danger">
                                                    Remove
                                                </button>
                                            </div>
                                        </template>
                                    </div>
                                    <button type="button" 
                                            @click="ingredients.push({})" 
                                            class="btn btn-secondary mt-2">
                                        Add Ingredient
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="btn btn-primary">
                                Update Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
