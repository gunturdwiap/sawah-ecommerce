<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Detail') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        @if (session()->has('success'))
            <div class="p-4 mb-4 text-sm text-green-800 bg-green-50" role="alert">
                <span class="font-medium">Sukses!</span>
                {{ session('success') }}
            </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="aspect-square w-full rounded-lg bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-7/8">
                @else
                    <div
                        class="aspect-square w-full rounded-lg bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-7/8 flex items-center justify-center">
                    </div>
                @endif
            </div>

            <div>
                <h1 class="text-3xl font-bold mb-2 text-gray-800">{{ $product->name }}</h1>
                @if($product->category)
                    <a href="{{ route('categories.products', ['category' => $product->category->slug]) }}">
                        <span class="inline-block bg-gray-200 text-gray-800 text-xs px-3 py-1 rounded-full mb-2">
                            {{ $product->category->name }}
                        </span>
                    </a>
                @endif
                <p class="text-xl text-green-600 font-semibold mb-2">Rp
                    {{ number_format($product->price, 0, ',', '.') }}
                </p>
                <p class="text-gray-700 mb-6 leading-relaxed">{{ $product->description }}</p>

                @if (!auth()?->user()?->is_admin)
                    <form action="{{ route('cart.store', $product) }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Add to Cart
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

</x-app-layout>