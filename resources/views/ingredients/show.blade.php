<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ingredient Details') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('ingredients.edit', $ingredient) }}" class="btn btn-warning">
                    Edit Ingredient
                </a>
                <a href="{{ route('ingredients.index') }}" class="btn btn-secondary">
                    Back to Ingredients
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Ingredient Information -->
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-semibold mb-4">Basic Information</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="font-medium">Name</label>
                                        <p>{{ $ingredient->name }}</p>
                                    </div>

                                    <div>
                                        <label class="font-medium">Unit</label>
                                        <p>{{ $ingredient->unit }}</p>
                                    </div>

                                    <div>
                                        <label class="font-medium">Cost per Unit</label>
                                        <p>${{ number_format($ingredient->cost_per_unit, 2) }}</p>
                                    </div>

                                    <div>
                                        <label class="font-medium">Stock</label>
                                        <p class="@if($ingredient->stock < 10) text-red-600 @endif">
                                            {{ $ingredient->stock }} {{ $ingredient->unit }}
                                        </p>
                                    </div>

                                    <div>
                                        <label class="font-medium">Status</label>
                                        <p>
                                            <span class="px-2 py-1 rounded text-sm @if($ingredient->active) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                                                {{ $ingredient->active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @if($ingredient->description)
                                <div>
                                    <h3 class="text-lg font-semibold mb-2">Description</h3>
                                    <p class="text-gray-600">{{ $ingredient->description }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Products Using This Ingredient -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Used in Products</h3>
                            @if($ingredient->products->isNotEmpty())
                                <div class="space-y-4">
                                    @foreach($ingredient->products as $product)
                                        <div class="bg-gray-50 p-4 rounded">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <h4 class="font-medium">
                                                        <a href="{{ route('products.show', $product) }}" 
                                                           class="text-blue-600 hover:text-blue-800">
                                                            {{ $product->name }}
                                                        </a>
                                                    </h4>
                                                    <p class="text-sm text-gray-600">SKU: {{ $product->sku }}</p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="font-medium">
                                                        {{ $product->pivot->quantity }} {{ $product->pivot->unit }}
                                                    </p>
                                                    <p class="text-sm text-gray-600">
                                                        per product
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-600">This ingredient is not used in any products yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
