<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Edit Kategori') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __("Perbarui nama kategori sesuai kebutuhan") }}
                        </p>
                    </header>

                    <section x-data="{
                            name: '{{ old('name', $category->name) }}',
                            get slug() {
                                return this.name
                                    .toLowerCase()
                                    .replace(/ /g, '-')
                                    .replace(/[^\w-]+/g, '');
                            }
                        }">

                        <form method="post" action="{{ route('categories.update', $category) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('PUT')

                            <div>
                                <x-input-label for="name" :value="__('Nama')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required
                                    autofocus autocomplete="name" x-model="name"
                                    value="{{ old('name', $category->name) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="slug" :value="__('Slug')" />
                                <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" required
                                    readonly autocomplete="slug" x-bind:value="slug"
                                    value="{{ old('slug', $category->slug) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Update') }}</x-primary-button>

                            </div>
                        </form>

                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
