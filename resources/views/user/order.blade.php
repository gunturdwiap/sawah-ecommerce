<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($orders->isEmpty())
                        <p>Anda belum memiliki pesanan</p>
                    @else
                        <div class="space-y-6">
                            @foreach($orders->groupBy('created_at') as $date => $dateOrders)
                                <div class="border rounded-lg p-4">
                                    <h3 class="font-semibold mb-4">Pesanan pada {{ $date }}</h3>

                                    <div class="space-y-2">
                                        @foreach($dateOrders as $order)
                                            <div class="flex justify-between">
                                                <span>{{ $order->product->name }} (x{{ $order->quantity }})</span>
                                                <span>Rp {{ number_format($order->price * $order->quantity, 0, ',', '.') }}</span>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="font-bold mt-4 pt-2 border-t">
                                        Total: Rp {{ number_format($dateOrders->sum(function($o) {
                                            return $o->price * $o->quantity;
                                        })), 0, ',', '.' }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
