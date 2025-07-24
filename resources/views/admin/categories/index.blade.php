<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Kategori') }}
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

                                    <a href="{{ route('admin.categories.create') }}">
                                        <x-primary-button type="button"
                                            class="flex items-center justify-center font-medium rounded-lg text-sm px-4 py-2 focus:outline-none">
                                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path clip-rule="evenodd" fill-rule="evenodd"
                                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                            </svg>
                                            Tambah Kategori
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
                                            <th scope="col" class="px-4 py-3">Slug</th>
                                            <th scope="col" class="px-4 py-3">Terakhir Diedit</th>
                                            <th scope="col" class="px-4 py-3"><span class="sr-only">Actions</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $category)
                                            <tr class="border-b border-gray-200">
                                                <th scope="row"
                                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                                    {{ $category->name }}
                                                </th>
                                                <td class="px-4 py-3">{{ $category->slug }}</td>
                                                <td class="px-4 py-3">{{ $category->updated_at->diffForHumans() }}</td>
                                                <td class="px-4 py-3 text-right">
                                                    <!-- Placeholder for action buttons -->
                                                    <div class="flex gap-3 items-center justify-end">

                                                        {{-- <a href="#" class="font-medium text-blue-600 hover:underline">
                                                            Detail
                                                        </a> --}}
                                                        <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}"
                                                            class="font-medium text-yellow-600 hover:underline">
                                                            Edit
                                                        </a>

                                                        <form method="POST"
                                                            action="{{ route('admin.categories.destroy', $category) }}"
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

                            <!-- Pagination -->
                            {{-- <nav
                                class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                                aria-label="Table navigation">
                                <span class="text-sm font-normal text-gray-500">
                                    Showing <span class="font-semibold text-gray-900">1-10</span> of
                                    <span class="font-semibold text-gray-900">1000</span>
                                </span>
                                <ul class="inline-flex items-stretch -space-x-px">
                                    <li>
                                        <a href="#"
                                            class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                                            <span class="sr-only">Previous</span>
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 01-1.414 0l4-4a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">1</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">2</a>
                                    </li>
                                    <li>
                                        <a href="#" aria-current="page"
                                            class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-blue-600 bg-blue-50 border border-blue-300 hover:bg-blue-100 hover:text-blue-700">3</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">...</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                                            <span class="sr-only">Next</span>
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </nav> --}}
                            {{ $categories->links() }}

                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>
