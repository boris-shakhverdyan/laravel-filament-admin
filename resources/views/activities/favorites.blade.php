<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Featured activities</h2>
    </x-slot>

    <div class="py-6 px-4 space-y-6">
        @forelse($favorites as $activity)
            <div class="bg-white shadow p-4 rounded-md">
                <h3 class="text-lg font-bold">{{ $activity->title }}</h3>
                <p class="text-gray-700">{{ $activity->short_description }}</p>
                <p class="text-sm text-gray-600">
                    Type: {{ $activity->type->name ?? '—' }} |
                    Partner: {{ $activity->partner->name ?? '—' }}
                </p>

                <form method="POST" action="{{ route('activities.unfavorite', $activity) }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500 hover:underline text-sm">Remove from favorites</button>
                </form>
            </div>
        @empty
            <p class="text-gray-500 italic">You don't have any favorite activities yet.</p>
        @endforelse

        <div class="mt-4">
            {{ $favorites->links() }}
        </div>
    </div>
</x-app-layout>
