<x-base-layout>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <h1 class="text-2xl font-bold">Admin Dashboard</h1>
        <div class="mt-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Match</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Referee</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($matches as $match)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $match->team1 }} vs {{ $match->team2 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $match->score1 }} - {{ $match->score2 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $match->current_time }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form method="POST" action="{{ route('assign.referee', $match->id) }}">
                                @csrf
                                <select name="tournament_id" class="block w-full">
                                    <option>Select Tournament</option>
                                    @foreach($tournaments as $tournament)
                                        <option value="{{ $tournament->id }}">{{ $tournament->title }}</option>
                                    @endforeach
                                </select>
                                <select name="team_1" class="block w-full">
                                    <option>Select Team 1</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                                <select name="team_2" class="block w-full">
                                    <option>Select Team 2</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Assign</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-base-layout>
