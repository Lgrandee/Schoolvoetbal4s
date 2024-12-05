<x-base-layout>
    @auth
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <h1 class="text-2xl font-bold">Edit Your Team</h1>

            @if(session('success'))
                <div class="mt-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('coach.edit') }}" class="mt-4" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $team->id }}">

                <label class="block text-sm font-medium text-gray-700" for="name">Naam:</label>
                <input class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" type="text" id="name" name="name" value="{{ $team->name }}" required><br><br>

                <label class="block text-sm font-medium text-gray-700" for="coach">Coach:</label>
                <input class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" type="text" id="coach" name="coach" value="{{ auth()->user()->name }}" required><br><br>

                <label class="block text-sm font-medium text-gray-700" for="player_count">Teamleden:</label>
                <input class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" type="number" id="player_count" name="player_count" value="{{ $team->player_count }}" required><br><br>

                <button type="submit" class="mt-2 bg-green-700 text-white px-4 py-2 rounded">Update Team</button>
            </form>
        </div>
    @else
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <h1 class="text-2xl font-bold">Access Denied</h1>
            <p>You must be logged in to view this page.</p>
        </div>
    @endauth
</x-base-layout>
