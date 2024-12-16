<x-base-layout>
    <h1 class="flex justify-center my-11 grid-rows-1 text-2xl font-bold">Leaderboard</h1>
    <div class="flex justify-center my-11 grid-rows-1">
        @if($teams->isEmpty())
            <p>No teams have been added yet.</p>
        @else
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Coach</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Player Count</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Points</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($teams as $index => $team)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $team->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $team->coach ? $team->coach->name : 'No coach assigned' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $team->player_count }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $team->points }}</td>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-base-layout>
