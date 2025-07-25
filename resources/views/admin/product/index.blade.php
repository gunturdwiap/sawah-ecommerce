<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">



                <section class="bg-gray-100 p-3 sm:p-5">
                    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                        <div class="bg-white relative shadow sm:rounded-lg overflow-hidden">

                            @if (session()->has('success'))
                                <div class="p-4 mb-4 text-sm text-green-800 bg-green-50" role="alert">
                                    <span class="font-medium">Sukses!</span>
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div
                                class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                                <!-- Search Input -->

                                <div class="w-full md:w-1/2">
                                    <form class="flex items-center">
                                        <label for="simple-search" class="sr-only">Search</label>
                                        <div class="relative w-full">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <svg aria-hidden="true" class="w-5 h-5 text-gray-400"
                                                    fill="currentColor" viewBox="0 0 20 20">
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

                                <!-- Action Buttons -->
                                <div
                                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">

                                    <a href="{{ route('admin.products.create') }}">
                                        <x-primary-button type="button"
                                            class="flex items-center justify-center font-medium rounded-lg text-sm px-4 py-2 focus:outline-none">
                                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path clip-rule="evenodd" fill-rule="evenodd"
                                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                            </svg>
                                            Tambah Produk
                                        </x-primary-button>
                                    </a>

                                </div>
                            </div>

                            <!-- Table -->
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-700">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                        <tr>
                                            <th scope="col" class="px-4 py-3">Nama</th>
                                            <th scope="col" class="px-4 py-3">Harga</th>
                                            <th scope="col" class="px-4 py-3">Deskripsi</th>
                                            <th scope="col" class="px-4 py-3">Gambar</th>
                                            <th scope="col" class="px-4 py-3">Terakhir Diedit</th>
                                            <th scope="col" class="px-4 py-3"><span class="sr-only">Actions</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $product)
                                            <tr class="border-b border-gray-200">
                                                <th scope="row"
                                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                                    {{ $product->name }}
                                                </th>
                                                <td class="px-4 py-3">{{ $product->price }}</td>
                                                <td class="px-4 py-3">{{ $product->description }}</td>
                                                <td class="px-4 py-3">
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product image" class="w-32 h-auto rounded">
                                                </td>
                                                <td class="px-4 py-3">{{ $product->updated_at->diffForHumans() }}</td>
                                                <td class="px-4 py-3 text-right">
                                                    <!-- Placeholder for action buttons -->
                                                    <div class="flex gap-3 items-center justify-end">
                                                        <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}"
                                                            class="font-medium text-yellow-600 hover:underline">
                                                            Edit
                                                        </a>

                                                        <form method="POST"
                                                            action="{{ route('admin.products.destroy', $product) }}"
                                                            class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="text-red-600 hover:text-red-800 font-medium text-sm focus:outline-none">
                                                                Hapus
                                                            </button>
                                                        </form>


                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="border-b border-gray-200">
                                                <th colspan="6" scope="row"
                                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap text-center justify-center">
                                                    Data Kosong
                                                </th>
                                            </tr>

                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{ $products->links() }}

                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>
