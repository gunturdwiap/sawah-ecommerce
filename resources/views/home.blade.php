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

                        <div class="w-full md:w-1/2 pb-10">
                            <form class="flex items-center">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-400" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input name="q" type="text" id="simple-search"
                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2"
                                        placeholder="Search">
                                </div>
                            </form>
                        </div>

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

                                    <div class="flex justify-between items-center mt-3">
                                        <h3 class="text-sm text-gray-700">{{ $product->name }}</h3>
                                        @if($product->category)
                                            <button>
                                                <span class="bg-gray-200 text-gray-800 text-xs px-3 py-1 rounded-full mb-2">
                                                    {{ $product->category->name }}
                                                </span>
                                            </button>
                                        @endif
                                    </div>

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