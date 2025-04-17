<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Все активности
        </h2>
    </x-slot>

    <div class="py-6 space-y-6">
        @forelse($activities as $activity)
            <div class="bg-white shadow rounded-md p-4 space-y-2">
                <h3 class="text-lg font-bold">{{ $activity->title }}</h3>

                <p class="text-sm text-gray-700">{{ $activity->short_description }}</p>

                <ul class="text-sm text-gray-600">
                    <li><strong>Тип:</strong> {{ $activity->type->name ?? '—' }}</li>
                    <li><strong>Партнёр:</strong> {{ $activity->partner->name ?? '—' }}</li>
                    <li><strong>Создано:</strong> {{ $activity->created_at->format('d.m.Y H:i') }}</li>
                </ul>

                @auth
                    @if(in_array($activity->id, $userFavorites ?? []))
                        <form method="POST" action="{{ route('activities.unfavorite', $activity) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 text-sm hover:underline">
                                Удалить из избранного
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('activities.favorite', $activity) }}">
                            @csrf
                            <button type="submit" class="text-blue-500 text-sm hover:underline">
                                Добавить в избранное
                            </button>
                        </form>
                    @endif
                @else
                    <p class="text-sm text-gray-400 italic">
                        Войдите, чтобы добавить в избранное.
                    </p>
                @endauth

                @if(!empty($activity->location) && is_array($activity->location))
                    <div id="map-{{ $activity->id }}"
                         class="w-full h-64 mt-4 rounded-md shadow-sm"
                         style="height: 300px"
                         data-coords='@json($activity->location)'>
                    </div>
                @endif
            </div>
        @empty
            <p class="text-gray-500">Нет активностей для отображения.</p>
        @endforelse

        <div class="mt-6">
            {{ $activities->links() }}
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
              integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
              crossorigin=""/>
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
                integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
                crossorigin=""></script>

        <script>
            window.addEventListener('load', () => {
                document.querySelectorAll('[id^="map-"]').forEach((el) => {
                    const coords = JSON.parse(el.dataset.coords || '[]');

                    if (coords.length === 0) return;

                    const map = L.map(el).setView([coords[0].lat, coords[0].lng], 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 18,
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(map);

                    const polygon = L.polygon(coords.map(p => [p.lat, p.lng]), {
                        color: 'blue',
                        fillOpacity: 0.3
                    }).addTo(map);

                    map.fitBounds(polygon.getBounds());
                });
            });
        </script>
    @endpush
</x-app-layout>
