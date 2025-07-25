<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($cartItems->isEmpty())
                        <p>Cart Empty</p>
                    @else
                        <div class="space-y-4">
                            @foreach($cartItems as $item)
                                <div class="flex justify-between items-center border-b pb-4">
                                    <div class="flex items-center space-x-4">
                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                             class="w-16 h-16 object-cover rounded">
                                        <div>
                                            <h3>{{ $item->product->name }}</h3>
                                            <p>Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span>Qty: {{ $item->quantity }}</span>
                                        <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach

                            <form action="{{ route('orders.store') }}" method="POST" class="mt-6">
                                @csrf
                                <button type="submit"
                                        class="bg-blue-500 text-white px-4 py-2 rounded">
                                    Buat Pesanan
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
