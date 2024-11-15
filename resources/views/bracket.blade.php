<x-base-layout>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <h1 class="text-2xl font-bold">Tournament Bracket</h1>

        @auth
            @if(Auth::user()->is_admin)
                <a href="{{ route('tournament.create') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Create Tournament</a>
            @endif
        @endauth

        <!-- Existing bracket content goes here -->
        <div class="mt-6">
            <div class="grid grid-cols-4 gap-4">
                @foreach($tournaments as $tournament)
                    <div class="border p-4 rounded">
                        <h3 class="font-semibold">{{ $tournament->title }}</h3>
                        <ul>
                            @foreach($tournament->games as $game)
                                <li class="mt-2">
                                    <div class="flex justify-between">
                                        <span>{{ $game->teamOne->name }}</span>
                                        <span>{{ $game->teamTwo->name }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>{{ $game->team_1_score }} - {{ $game->team_2_score }}</span>
                                        <span>{{ $game->current_time }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-base-layout>
