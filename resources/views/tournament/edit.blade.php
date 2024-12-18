<x-base-layout>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <h1 class="text-2xl font-bold">Edit Tournament: {{ $tournament->title }}</h1>

        <form method="POST" action="{{ route('tournament.update', $tournament) }}" class="mt-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Tournament Title</label>
                <input type="text" name="title" id="title" value="{{ $tournament->title }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
            </div>
            <div class="mb-4">
                <label for="max_teams" class="block text-sm font-medium text-gray-700">Max Teams</label>
                <input type="number" name="max_teams" id="max_teams" value="{{ $tournament->max_teams }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
            </div>
            <button type="submit" class="mt-2 bg-green-700 text-white px-4 py-2 rounded">Update Tournament</button>
        </form>

        <h2 class="text-xl font-bold mt-6">Add Teams</h2>
        <form method="POST" action="{{ route('tournament.addTeam', $tournament) }}" class="mt-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                @foreach($teams as $team)
                <div class="flex items-center">
                    <input type="checkbox"
                               name="team_id[]"
                               value="{{ $team->id }}"
                               id="team_{{ $team->id }}"
                               class="rounded border-gray-300"
                               {{ $tournament->teams->contains($team->id) ? 'checked' : '' }}>
                               <label for="team_{{ $team->id }}" class="ml-2">
                                   {{ $team->name }}
                                </label>
                            </div>
                            @endforeach
            </div>
            <button type="submit" class="mt-4 bg-blue-700 text-white px-4 py-2 rounded">Add Selected Teams</button>
        </form>

        <div class="mt-6">
            <h3 class="text-lg font-semibold">Current Teams in Tournament</h3>
            <div class="mt-2">
                @if($tournament->teams->count() > 0)
                <ul class="list-disc pl-5">
                    @foreach($tournament->teams as $team)
                    <li>{{ $team->name }}</li>
                    @endforeach
                </ul>
                @else
                <p class="text-gray-500">No teams assigned yet.</p>
                @endif
            </div>
        </div>

        <h2 class="text-xl font-bold mt-6">Add Referees</h2>
        <form method="POST" action="{{ route('tournament.addReferee', $tournament) }}" class="mt-4">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Select Referees</label>
                <select name="referee_id[]" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                    @foreach($referees as $referee)
                    <option value="{{ $referee->id }}">{{ $referee->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="mt-2 bg-blue-700 text-white px-4 py-2 rounded">Add Referees</button>
        </form>
    </div>
</x-base-layout>
