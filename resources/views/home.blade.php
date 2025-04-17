<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Все активности</h2>
    </x-slot>

    <div class="py-6 px-4 space-y-6">
        @foreach($activities as $activity)
            <div class="bg-white shadow p-4 rounded-md">
                <h3 class="text-lg font-bold">{{ $activity->title }}</h3>
                <p class="text-gray-700">{{ $activity->short_description }}</p>
                <p class="text-sm text-gray-600">
                    Тип: {{ $activity->type->name ?? '—' }} |
                    Партнёр: {{ $activity->partner->name ?? '—' }}
                </p>

                @auth
                    @if(in_array($activity->id, $userFavorites ?? []))
                        <form method="POST" action="{{ route('activities.unfavorite', $activity) }}">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:underline text-sm">Удалить из избранного</button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('activities.favorite', $activity) }}">
                            @csrf
                            <button class="text-blue-500 hover:underline text-sm">Добавить в избранное</button>
                        </form>
                    @endif
                @endauth
            </div>
        @endforeach

        <div class="mt-4">
            {{ $activities->links() }}
        </div>
    </div>
</x-app-layout>
