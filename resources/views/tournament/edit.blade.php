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
            @foreach($teams as $index => $team)
                <div class="mb-4">
                    <label for="team_id_{{ $index }}" class="block text-sm font-medium text-gray-700">Select Team</label>
                    <select name="team_id[]" id="team_id_{{ $index }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                        <option value="">Select a team</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
            <button type="submit" class="mt-2 bg-blue-700 text-white px-4 py-2 rounded">Add Teams</button>
        </form>

        <h2 class="text-xl font-bold mt-6">Add Referees</h2>
        <form method="POST" action="{{ route('tournament.addReferee', $tournament) }}" class="mt-4">
            @csrf
            @foreach($referees as $index => $referee)
                <div class="mb-4">
                    <label for="referee_name_{{ $index }}" class="block text-sm font-medium text-gray-700">Referee Name</label>
                    <input type="text" name="referee_name[]" id="referee_name_{{ $index }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                </div>
            @endforeach
            <button type="submit" class="mt-2 bg-blue-700 text-white px-4 py-2 rounded">Add Referees</button>
        </form>
    </div>
</x-base-layout>
