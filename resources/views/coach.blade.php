<x-base-layout>
    @auth
        @if(Auth::user()->is_admin || Auth::user()->is_coach)
            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <h1 class="text-2xl font-bold">Add a Team</h1>

                @if(session('success'))
                    <div class="mt-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('coach.store') }}" class="mt-4">
                    @csrf
                    <div class="mb-4">
                        <label for="team_name" class="block text-sm font-medium text-gray-700">Team Name</label>
                        <input type="text" name="team_name" id="team_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                    </div>
                    <div class="mb-4">
                        <label for="tournament_id" class="block text-sm font-medium text-gray-700">Select Tournament</label>
                        <select name="tournament_id" id="tournament_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                            <option value="">Select Tournament</option>
                            @foreach($tournaments as $tournament)
                                <option value="{{ $tournament->id }}">{{ $tournament->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="mt-2 bg-green-700 text-white px-4 py-2 rounded">Add Team</button>
                </form>
            </div>
        @else
            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <h1 class="text-2xl font-bold">Access Denied</h1>
                <p>You do not have permission to view this page.</p>
            </div>
        @endif
    @else
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <h1 class="text-2xl font-bold">Access Denied</h1>
            <p>You must be logged in to view this page.</p>
        </div>
    @endauth
</x-base-layout>
