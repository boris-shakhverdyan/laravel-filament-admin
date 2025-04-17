<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex py-2 justify-between items-center">
            <div class="flex gap-3 m-0">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Partners</h2>
                <a href="{{ route('home') }}" class="text-2xl text-blue-600 hover:underline">Activities</a>
            </div>

            @guest
                <div class="flex gap-3 m-0">
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a>
                </div>
            @endguest
        </div>
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
