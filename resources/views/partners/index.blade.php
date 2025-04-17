<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Partners</h2>
    </x-slot>

    <div class="py-6 px-4 space-y-6">
        @foreach($partners as $partner)
            <div class="bg-white shadow p-4 rounded-md">
                <h3 class="text-lg font-bold">{{ $partner->name }}</h3>
                <p class="text-gray-700">{{ $partner->website }}</p>
            </div>
        @endforeach

        <div class="mt-4">
            {{ $partners->links() }}
        </div>
    </div>
</x-app-layout>
