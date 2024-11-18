<x-base-layout>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <h1 class="text-2xl font-bold">Admin Dashboard</h1>
        <div class="mt-6">
            @if ($games->isEmpty())
                <p>No matches available.</p>
            @else
                <table class="min-w-full divide-y divide-gray-200">
                    <tr>
                        <th>Game</th>
                        <th>Score</th>
                        <th>Field</th>
                        <th>Referee</th>
                    </tr>
                    @foreach($games as $game)
                    <tr>
                        <td>{{ $game->teamOne->name }} vs {{ $game->teamTwo->name }}</td>
                        <td>{{ $game->team1_score }} - {{ $game->team2_score }}</td>
                        <td>{{ $game->field }}</td>
                        <td>{{ $game->referee->name }}</td>
                    </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
</x-base-layout>
