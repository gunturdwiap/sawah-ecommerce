<x-app-layout >
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="productModal()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 ">
                <x-primary-button @click="$dispatch('open-modal', 'create-modal')">
                    Buat Produk
                </x-primary-button>
                <div class="p-6 text-gray-900"> 
                    <div class="mt-6 overflow-x-auto">
                        <table class="w-full table-auto border-collapse border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 border">#</th>
                                    <th class="px-4 py-2 border">Nama Produk</th>
                                    <th class="px-4 py-2 border">Harga</th>
                                    <th class="px-4 py-2 border">Deskripsi</th>
                                    <th class="px-4 py-2 border">Gambar</th>
                                    <th class="px-4 py-2 border">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $index => $product)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 border">{{ $product->name }}</td>
                                    <td class="px-4 py-2 border">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2 border">{{ $product->description }}</td>
                                    <td class="px-4 py-2 border">
                                     <img src="{{ asset('storage/' . $product->image) }}" alt="Product image" class="w-32 h-auto rounded">
                                 </td>
                                 <td class="px-4 py-2 border">
                                    <button @click='editProduct(@json($product))' class="text-blue-500 hover:underline mr-2">Edit</button>
                                    <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" @click="deleteProduct('{{ route('product.destroy', $product->id) }}')" class="text-red-500 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
    </div>

    <div>
        <x-modal name="create-modal">
            <div class="bg-white rounded p-6 w-full">
                <h2 class="text-lg font-bold mb-4">Tambah Produk</h2>
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" @submit.prevent="createProduct">
                    @csrf
                    <div class="mb-4">
                        <label class="block">Nama Produk</label>
                        <input name="name" type="text" class="w-full border px-3 py-2 rounded" placeholder="cth:indomie goreng" required>
                    </div>
                    <div class="mb-4">
                        <label class="block">Harga</label>
                        <input name="price" type="number" class="w-full border px-3 py-2 rounded" placeholder="cth:18000" required>
                    </div>
                    <div class="mb-4">
                        <label class="block">Deskripsi</label>
                        <textarea name="description" class="w-full border px-3 py-2 rounded" required id="" placeholder="cth: mie dengan rasa nusantara ..." ></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block">Gambar</label>
                        <input name="image" type="file" accept="image/*" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="$dispatch('close-modal', 'create-modal')" class="bg-gray-300 px-4 py-2 rounded">Batal</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded flex items-center" :disabled="loading">
                            <svg x-show="loading" class="animate-spin h-4 w-4 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                            </svg>
                            <span x-text="loading ? 'Menyimpan...' : 'Simpan'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </x-modal>
        <x-modal name="update-modal">
            <div class="bg-white rounded p-6 w-full">
                <h2 class="text-lg font-bold mb-4">Edit Produk</h2>
                <form :action="`/admin/product/${editForm.id}`" method="POST" enctype="multipart/form-data" @submit.prevent="updateProduct">
                    @csrf
                    @method('PUT')
                    <div class="w-full"> 
                        <div class="mb-4">
                            <label class="block">Nama Produk</label>
                            <input name="name" x-model="editForm.name" type="text" class="w-full border px-3 py-2 rounded" required>
                        </div>
                        <div class="mb-4">
                            <label class="block">Harga</label>
                            <input name="price" x-model="editForm.price" type="number" class="w-full border px-3 py-2 rounded" required>
                        </div>
                        <div class="mb-4">
                            <label class="block mb-1">Gambar Saat Ini</label>
                            <template x-if="editForm.image">
                                <img :src="`/storage/${editForm.image}`" alt="Current product image" class="w-32 h-32 object-cover rounded mb-2">
                            </template>
                            <label class="block">Upload Gambar Baru</label> 
                            <input name="image" type="file" class="w-full border px-3 py-2 rounded">
                            <small class="text-red-500 block mt-1">* Jika tidak ingin mengganti gambar, biarkan kosong.</small>
                        </div>
                        <div class="mb-4">
                            <label class="block">Deskripsi</label>
                            <textarea name="description" x-model="editForm.description" class="w-full border px-3 py-2 rounded" required></textarea>
                        </div>
                        <div class="flex justify-end gap-2">
                            <button type="button" @click="closeEditModal()" class="bg-gray-300 px-4 py-2 rounded">Batal</button>
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded flex items-center" :disabled="loading">
                                <svg x-show="loading" class="animate-spin h-4 w-4 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                </svg>
                                <span x-text="loading ? 'Menyimpan...' : 'Update'"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </x-modal>

    </div>
</div>

<script>
    function productModal() {
        return {
            loading: false,
            editForm: {
                id: null,
                name: '',
                price: '',
                description: '',
                image: ''
            },

            createProduct(event) {
                this.loading = true;
                const form = event.target;
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    this.loading = false;
                    this.$dispatch('close-modal', 'create-modal');
                    form.reset();
                    location.reload();
                })
                .catch(error => {
                    this.loading = false;
                    console.error(error);
                });
            },

            updateProduct(event) {
                this.loading = true;
                const form = event.target;
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST', 
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    this.loading = false;
                    this.closeEditModal();
                    location.reload();
                })
                .catch(error => {
                    this.loading = false;
                    console.error(error);
                });
            },

            deleteProduct(url) {
                if (!confirm("Hapus produk ini?")) return;

                this.loading = true;
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ _method: 'DELETE' })
                })
                .then(res => res.json())
                .then(() => {
                    this.loading = false;
                    location.reload();
                })
                .catch(error => {
                    this.loading = false;
                    console.error(error);
                });
            },

            editProduct(product) {
                this.editForm = { ...product };
                this.$dispatch('open-modal', 'update-modal');
            },

            closeEditModal() {
                this.$dispatch('close-modal', 'update-modal');
                this.editForm = {
                    id: null,
                    name: '',
                    price: '',
                    description: '',
                    image: ''
                };
            }
        }
    }
</script>

</x-app-layout>
