<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Product Details') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">
                    Edit Product
                </a>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">
                    Back to Products
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Product Information -->
                        <div>
                            <div class="mb-6">
                                @if ($product->image_path)
                                    <img src="{{ Storage::url($product->image_path) }}" 
                                         alt="{{ $product->name }}"
                                         class="w-full max-w-md rounded shadow-lg">
                                @else
                                    <div class="w-full max-w-md h-64 bg-gray-200 rounded flex items-center justify-center">
                                        <span class="text-gray-500">No image available</span>
                                    </div>
                                @endif
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                                    <p class="text-gray-600">{{ $product->description }}</p>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="font-medium">SKU</label>
                                        <p>{{ $product->sku }}</p>
                                    </div>

                                    <div>
                                        <label class="font-medium">Price</label>
                                        <p>${{ number_format($product->price, 2) }}</p>
                                    </div>

                                    <div>
                                        <label class="font-medium">Stock</label>
                                        <p class="@if($product->stock < 10) text-red-600 @endif">
                                            {{ $product->stock }}
                                        </p>
                                    </div>

                                    <div>
                                        <label class="font-medium">Status</label>
                                        <p>
                                            <span class="px-2 py-1 rounded text-sm @if($product->active) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                                                {{ $product->active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ingredients List -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Ingredients</h3>
                            @if($product->ingredients->isNotEmpty())
                                <div class="space-y-4">
                                    @foreach($product->ingredients as $ingredient)
                                        <div class="bg-gray-50 p-4 rounded">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <h4 class="font-medium">{{ $ingredient->name }}</h4>
                                                    <p class="text-sm text-gray-600">{{ $ingredient->description }}</p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="font-medium">
                                                        {{ $ingredient->pivot->quantity }} {{ $ingredient->pivot->unit }}
                                                    </p>
                                                    <p class="text-sm text-gray-600">
                                                        Stock: {{ $ingredient->stock }} {{ $ingredient->unit }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-600">No ingredients associated with this product.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
