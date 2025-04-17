<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex py-2 justify-between items-center">
            <div class="flex gap-3 m-0">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
                <a href="{{ route('home') }}" class="text-2xl text-blue-600 hover:underline">Activities</a>
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
