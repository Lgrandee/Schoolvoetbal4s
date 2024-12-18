<x-base-layout>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <h1 class="text-2xl font-bold">{{ $tournament->title }} Bracket</h1>

        @auth
            @if(auth()->user()->team)
                @if($tournament->teams->contains(auth()->user()->team->id))
                    <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        Your team is signed up for this tournament!
                    </div>
                @else
                    <div class="mt-4">
                        <form method="POST" action="{{ route('tournament.signup', $tournament) }}">
                            @csrf
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Sign Up My Team
                            </button>
                        </form>
                    </div>
                @endif
            @endif
        @endauth

        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-2">Signed Up Teams ({{ $tournament->teams->count() }})</h2>
            <div class="bg-white shadow rounded-lg p-4">
                <ul class="space-y-2">
                    @foreach($tournament->teams as $team)
                        <li class="flex items-center">
                            <span class="font-medium">{{ $team->name }}</span>
                            @if(auth()->check() && auth()->user()->team && auth()->user()->team->id === $team->id)
                                <span class="ml-2 text-sm text-gray-600">(Your Team)</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        @auth
            @if(auth()->user()->is_admin && !$tournament->started)
                <div class="mt-6">
                    <form method="POST" action="{{ route('tournament.start', $tournament) }}">
                        @csrf
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                            {{ $tournament->teams->count() < 2 ? 'disabled' : '' }}>
                            Start Tournament
                        </button>
                    </form>
                </div>
            @endif
        @endauth

        @if(!$tournament->started)
            <div class="mt-4 bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
                Waiting for admin to start the tournament.
            </div>
        @endif

        <div class="tournament-bracket mt-6">
            <div class="rounds flex justify-between">
                <!-- Round 1 -->
                <div class="round">
                    <h3 class="text-lg font-semibold mb-4">Round 1</h3>
                    <div class="matches space-y-4">
                        @foreach($matchups as $match)
                            <div class="match border p-4 rounded relative">
                                <a href="{{ route('match.details', $match->id) }}" class="block cursor-pointer hover:bg-gray-50">
                                    <div class="team-1 mb-2">
                                        <span class="font-medium">{{ $match->team1->name }}</span>
                                        @if(!$match->winner_id)
                                            <form method="POST" action="{{ route('tournament.advance', [$tournament, $match->team1->id]) }}" class="inline" onclick="event.stopPropagation()">
                                                @csrf
                                                <button type="submit" class="ml-2 text-sm bg-green-500 text-white px-2 py-1 rounded">
                                                    Win
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    <div class="team-2">
                                        <span class="font-medium">{{ $match->team2->name }}</span>
                                        @if(!$match->winner_id)
                                            <form method="POST" action="{{ route('tournament.advance', [$tournament, $match->team2->id]) }}" class="inline" onclick="event.stopPropagation()">
                                                @csrf
                                                <button type="submit" class="ml-2 text-sm bg-green-500 text-white px-2 py-1 rounded">
                                                    Win
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </a>
                                <div class="connector-right absolute top-1/2 -right-4 w-4 h-px bg-gray-300"></div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Subsequent rounds will be populated dynamically -->
                @foreach($rounds as $roundNumber => $roundMatches)
                    <div class="round">
                        <h3 class="text-lg font-semibold mb-4">Round {{ $roundNumber + 2 }}</h3>
                        <div class="matches space-y-8">
                            @foreach($roundMatches as $match)
                                <div class="match border p-4 rounded relative">
                                    <a href="{{ route('match.details', $match->id) }}" class="block cursor-pointer hover:bg-gray-50">
                                        @if($match->team1)
                                            <div class="team-1 mb-2">
                                                <span class="font-medium">{{ $match->team1->name }}</span>
                                                @if(!$match->winner_id)
                                                    <form method="POST" action="{{ route('tournament.advance', [$tournament, $match->team1->id]) }}" class="inline" onclick="event.stopPropagation()">
                                                        @csrf
                                                        <button type="submit" class="ml-2 text-sm bg-green-500 text-white px-2 py-1 rounded">
                                                            Win
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        @endif
                                        @if($match->team2)
                                            <div class="team-2">
                                                <span class="font-medium">{{ $match->team2->name }}</span>
                                                @if(!$match->winner_id)
                                                    <form method="POST" action="{{ route('tournament.advance', [$tournament, $match->team2->id]) }}" class="inline" onclick="event.stopPropagation()">
                                                        @csrf
                                                        <button type="submit" class="ml-2 text-sm bg-green-500 text-white px-2 py-1 rounded">
                                                            Win
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        @endif
                                    </a>
                                    <div class="connector-right absolute top-1/2 -right-4 w-4 h-px bg-gray-300"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <style>
            .tournament-bracket {
                overflow-x: auto;
            }
            .rounds {
                min-width: max-content;
                padding: 20px;
            }
            .round {
                min-width: 200px;
                margin-right: 40px;
            }
            .match {
                background: white;
                margin-bottom: 20px;
            }
        </style>
    </div>
</x-base-layout>
