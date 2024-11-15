<x-base-layout>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <h1 class="text-2xl font-bold">Tournament Bracket</h1>

        @auth
            @if(Auth::user()->is_admin)
                <a href="{{ route('tournament.create') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Create Tournament</a>
            @endif
        @endauth

        <!-- Existing bracket content goes here -->
    </div>
</x-base-layout>
