<x-base-layout>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <h1 class="text-2xl font-bold">Tournaments</h1>

        @auth
            @if(Auth::user()->is_admin)
                <a href="{{ route('tournament.create') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Create Tournament</a>
            @endif
        @endauth

        <div class="mt-6">
            <div class="grid grid-cols-4 gap-4">
                @foreach($tournaments as $tournament)
                    <div class="border p-4 rounded">
                        <h3 class="font-semibold">
                            <a href="{{ route('tournament.bracket', $tournament) }}" class="text-blue-600 hover:text-blue-900">
                                {{ $tournament->title }}
                            </a>
                        </h3>
                        @auth
                            @if(Auth::user()->is_admin)
                                <a href="{{ route('tournament.edit', $tournament) }}"
                                   class="mt-2 inline-block bg-green-500 text-white px-3 py-1 rounded text-sm">
                                    Manage Teams
                                </a>
                            @endif
                        @endauth
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-base-layout>
