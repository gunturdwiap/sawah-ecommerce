<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Edit Produk') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __("Perbarui detail Produk sesuai kebutuhan.") }}
                        </p>
                    </header>

                    <section >
                        <form method="post" action="{{ route('admin.products.update',$product) }}"
                            class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div>
                                <x-input-label for="name" :value="__('Nama Produk')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required
                                    autofocus autocomplete="name"
                                    value="{{ old('name', $product->name) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="price" :value="__('Harga')" />
                                <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" required
                                    autocomplete="price" value="{{ old('price', $product->price) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('price')" />
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('Deskripsi')" />
                                <textarea id="description" name="description"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required autocomplete="description">{{ old('description', $product->description) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <div>
                                <x-input-label for="categories" :value="__('Kategori')" />
                                <select name="category_id" id=""  class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                   >
                                   <option disabled> Pilih Kategori</option>
                                   @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" {{ old('category_id', $product->category_id ?? '') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                            </div>

                            <div>
                                <x-input-label for="image" :value="__('Photo Produk')" />
                                @if ($product->image)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                            class="w-32 h-32 object-cover rounded-md">
                                        <p class="text-sm text-gray-500 mt-1">Gambar saat ini</p>
                                    </div>
                                @endif
                                <x-text-input id="image" name="image" type="file"
                                    class="w-full border px-3 py-2 rounded mt-2"
                                    autocomplete="image" accept="image/*" />
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                                <p class="text-sm text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Update') }}</x-primary-button>

                                @if (session('success'))
                                    <p x-data="{ show: true }" x-show="show" x-transition
                                        x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600">
                                        {{ session('success') }}
                                    </p>
                                @endif
                            </div>
                        </form>

                    </section>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
