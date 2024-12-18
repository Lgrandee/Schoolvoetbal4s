<x-base-layout>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <h1 class="text-2xl font-bold">{{ $tournament->title }} Bracket</h1>

        @if($winner)
            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                <span class="font-bold">{{ $winner->name }}</span> is the Winner!
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
                                <div class="team-1 mb-2">
                                    <span class="font-medium">{{ $match->team1->name }}</span>
                                    @if(!$match->winner_id)
                                        <form method="POST" action="{{ route('tournament.advance', [$tournament, $match->team1->id]) }}" class="inline">
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
                                        <form method="POST" action="{{ route('tournament.advance', [$tournament, $match->team2->id]) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="ml-2 text-sm bg-green-500 text-white px-2 py-1 rounded">
                                                Win
                                            </button>
                                        </form>
                                    @endif
                                </div>
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
                                    @if($match->team1)
                                        <div class="team-1 mb-2">
                                            <span class="font-medium">{{ $match->team1->name }}</span>
                                            @if(!$match->winner_id)
                                                <form method="POST" action="{{ route('tournament.advance', [$tournament, $match->team1->id]) }}" class="inline">
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
                                                <form method="POST" action="{{ route('tournament.advance', [$tournament, $match->team2->id]) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" class="ml-2 text-sm bg-green-500 text-white px-2 py-1 rounded">
                                                        Win
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endif
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
