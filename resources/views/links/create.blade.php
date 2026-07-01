<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Создать короткую ссылку
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('links.store') }}">
                    @csrf

                    <div>
                        <x-input-label for="original_url" value="Оригинальный URL" />
                        <x-text-input id="original_url" name="original_url" type="url"
                                      class="mt-1 block w-full"
                                      placeholder="https://example.com/page"
                                      value="{{ old('original_url') }}" required autofocus />
                        <x-input-error :messages="$errors->get('original_url')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4 mt-6">
                        <x-primary-button>Создать</x-primary-button>
                        <a href="{{ route('links.index') }}" class="text-sm text-gray-500 hover:underline">
                            Отмена
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>