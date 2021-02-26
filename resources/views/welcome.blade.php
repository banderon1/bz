<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
            @endauth
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <form method="GET" action="/">
                    <x-input id="zip" type="number" class="block mt-1 w-full" name="zip" :value="old('zip')" required autofocus />
                </form>
            </div>
        </div>

        @if ($data)
            <div class="mb-4 font-medium text-sm text-green-600">
                <div>Temperature: <?= $data['main']['temp'] ?></div>
                <div>Description: <?= $data['weather'][0]['description'] ?></div>
            </div>
        @endif

    </div>
</x-guest-layout>
