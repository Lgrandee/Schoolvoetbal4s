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

        <div class="mt-6">
            <h2 class="text-xl font-bold">Tournaments</h2>
            @if ($tournaments->isEmpty())
                <p>No tournaments available.</p>
            @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Max Teams</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($tournaments as $tournament)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $tournament->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $tournament->max_teams }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('tournament.edit', $tournament) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                <form action="{{ route('tournament.destroy', $tournament) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 ml-2" onclick="return confirm('Are you sure you want to delete this tournament?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-base-layout>
