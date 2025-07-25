<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produk') }}
        </h2>
        <p>
            Kategori : {{ $category->name ?? 'Semua' }}
        </p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white">
                    <div class="mx-auto max-w-2xl px-4 py-10 sm:px-3 sm:py-10 lg:max-w-7xl lg:px-8">
                        <h2 class="sr-only">Products</h2>

                        <div
                            class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                            @foreach($products as $product)
                                <a href="{{ route('products.product-detail', ['id' => $product->id]) }}" class="group">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="aspect-square w-full rounded-lg bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-7/8" />
                                    @else
                                        <div
                                            class="aspect-square w-full rounded-lg bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-7/8 flex items-center justify-center">
                                        </div>
                                    @endif
                                    <h3 class="mt-4 text-sm text-gray-700">{{ $product->name }}</h3>
                                    <p class="mt-1 text-lg font-medium text-gray-900">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>