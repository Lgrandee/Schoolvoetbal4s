<x-base-layout>
    <div class="container mx-auto px-4 py-6">
        <a href="{{ route('tournament.bracket', $tournament) }}" class="text-blue-600 hover:text-blue-800">← Back to Bracket</a>

        <h1 class="text-2xl font-bold mt-6">Match Details</h1>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-6">
            <h2 class="text-xl mb-4">{{ $match->team1->name }} vs {{ $match->team2->name }}</h2>
            <p class="text-gray-600">Round {{ $match->round }}</p>

            @if($match->winner_id)
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-4">
                    Winner: {{ $match->winner->name }}
                </div>
            @endif

            @auth
                @if(auth()->user()->role === 'referee')
                    <form action="{{ route('match.update-scores', $game->id) }}" method="POST" class="mt-6">
                        @csrf
                        @method('PUT')
                        <div class="flex items-center space-x-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">{{ $match->team1->name }}</label>
                                <input type="number" name="team1_score" value="{{ $game->team1_score }}" min="0"
                                    class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <span class="text-xl font-bold">-</span>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">{{ $match->team2->name }}</label>
                                <input type="number" name="team2_score" value="{{ $game->team2_score }}" min="0"
                                    class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Score
                            </button>
                        </div>
                    </form>

                    <!-- Goal Recording Form -->
                    <div class="mt-8">
                        <h3 class="text-lg font-bold mb-4">Record Goal</h3>
                        <form action="{{ route('match.record-goal', $game->id) }}" method="POST" class="flex items-end space-x-4">
                            @csrf
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Player</label>
                                <select name="player_id" required class="shadow border rounded py-2 px-3 text-gray-700">
                                    <optgroup label="{{ $match->team1->name }}">
                                        @foreach($match->team1->players as $player)
                                            <option value="{{ $player->id }}">{{ $player->name }}</option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="{{ $match->team2->name }}">
                                        @foreach($match->team2->players as $player)
                                            <option value="{{ $player->id }}">{{ $player->name }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Minute</label>
                                <input type="number" name="minute" required min="1" max="90"
                                    class="shadow appearance-none border rounded py-2 px-3 text-gray-700">
                            </div>
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Record Goal
                            </button>
                        </form>
                    </div>
                @endif
            @endauth

            <!-- Display Goals -->
            <div class="mt-8">
                <h3 class="text-lg font-bold mb-4">Goals</h3>
                @if($game->goals && $game->goals->count() > 0)
                    @foreach($game->goals as $goal)
                        <div class="mb-2">
                            <span class="font-medium">{{ $goal->player->name }}</span>
                            <span class="text-gray-600">({{ $goal->minute }}')</span>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-600">No goals recorded yet.</p>
                @endif
            </div>
        </div>
    </div>
</x-base-layout>
