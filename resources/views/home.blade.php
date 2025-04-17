<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex py-2 justify-between items-center">
            <div class="flex gap-3 m-0">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Activities</h2>
                <a href="{{ route('partners.index') }}" class="text-2xl text-blue-600 hover:underline">Partners</a>
            </div>

            @guest
                <div class="flex gap-3 m-0">
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a>
                </div>
            @endguest
        </div>
    </x-slot>


    <div class="py-6 px-6 space-y-6">
        @forelse($activities as $activity)
            <div class="bg-white shadow rounded-md p-4 space-y-2">
                <h3 class="text-lg font-bold">{{ $activity->title }}</h3>

                <p class="text-sm text-gray-700"><b>Short description: </b>{{ $activity->short_description }}</p>

                <p class="text-sm text-gray-700"><b>Description: </b>{{ $activity->description }}</p>

                <ul class="text-sm text-gray-600">
                    <li><strong>Type:</strong> {{ $activity->type->name ?? '—' }}</li>
                    <li><strong>Partner:</strong> {{ $activity->partner->name ?? '—' }}</li>
                    <li><strong>Created At:</strong> {{ $activity->created_at->format('d.m.Y H:i') }}</li>
                </ul>

                @auth
                    @if(in_array($activity->id, $userFavorites ?? []))
                        <form method="POST" action="{{ route('activities.unfavorite', $activity) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 text-sm hover:underline">
                                Remove from favorites
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('activities.favorite', $activity) }}">
                            @csrf
                            <button type="submit" class="text-blue-500 text-sm hover:underline">
                                Add to Favorites
                            </button>
                        </form>
                    @endif
                @else
                    <p class="text-sm text-gray-400 italic">
                        Login to add to favorites.
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
            <p class="text-gray-500">There are no activities to display.</p>
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
