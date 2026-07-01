<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Мои ссылки
            </h2>
            <a href="{{ route('links.create') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                + Создать ссылку
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    @if ($links->isEmpty())
                        <p class="text-gray-500">У вас пока нет ссылок. Создайте первую!</p>
                    @else
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-gray-500 uppercase border-b">
                                <tr>
                                    <th class="py-2 pr-4">Оригинальный URL</th>
                                    <th class="py-2 pr-4">Короткая ссылка</th>
                                    <th class="py-2 pr-4">Переходов</th>
                                    <th class="py-2 pr-4">Создана</th>
                                    <th class="py-2 pr-4">Действия</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @foreach ($links as $link)
                                    <tr>
                                        <td class="py-3 pr-4 max-w-xs truncate">
                                            <a href="{{ $link->original_url }}" target="_blank" class="text-blue-600 hover:underline">
                                                {{ $link->original_url }}
                                            </a>
                                        </td>
                                        <td class="py-3 pr-4">
                                            <a href="{{ $link->short_url }}" target="_blank" class="text-blue-600 hover:underline">
                                                {{ $link->short_url }}
                                            </a>
                                        </td>
                                        <td class="py-3 pr-4">
                                            {{ $link->clicks_count }}
                                        </td>
                                        <td class="py-3 pr-4 text-gray-500">
                                            {{ $link->created_at->format('d.m.Y H:i') }}
                                        </td>
                                        <td class="py-3 pr-4 flex gap-3">
                                            <a href="{{ route('links.show', $link) }}" class="text-indigo-600 hover:underline">
                                                Статистика
                                            </a>
                                            <form action="{{ route('links.destroy', $link) }}" method="POST"
                                                  onsubmit="return confirm('Удалить эту ссылку?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">
                                                    Удалить
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>