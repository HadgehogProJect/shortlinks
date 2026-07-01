<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Статистика ссылки
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-sm text-gray-500">Оригинальный URL</p>
                <a href="{{ $link->original_url }}" target="_blank" class="text-blue-600 hover:underline break-all">
                    {{ $link->original_url }}
                </a>

                <p class="text-sm text-gray-500 mt-4">Короткая ссылка</p>
                <a href="{{ $link->short_url }}" target="_blank" class="text-blue-600 hover:underline">
                    {{ $link->short_url }}
                </a>

                <p class="text-sm text-gray-500 mt-4">Всего переходов</p>
                <p class="text-2xl font-bold">{{ $link->clicks()->count() }}</p>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-gray-800 mb-4">История переходов</h3>

                @if ($clicks->isEmpty())
                    <p class="text-gray-500">Переходов пока не было.</p>
                @else
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-500 uppercase border-b">
                            <tr>
                                <th class="py-2 pr-4">IP-адрес</th>
                                <th class="py-2 pr-4">Дата и время</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($clicks as $click)
                                <tr>
                                    <td class="py-2 pr-4">{{ $click->ip_address }}</td>
                                    <td class="py-2 pr-4">{{ $click->clicked_at->format('d.m.Y H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $clicks->links() }}
                    </div>
                @endif
            </div>

            <a href="{{ route('links.index') }}" class="text-sm text-gray-500 hover:underline">
                ← Назад к списку ссылок
            </a>

        </div>
    </div>
</x-app-layout>