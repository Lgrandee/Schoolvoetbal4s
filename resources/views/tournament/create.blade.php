<x-base-layout>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <h1 class="text-2xl font-bold">Create a Tournament</h1>

        @if(session('success'))
            <div class="mt-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('tournament.store') }}" class="mt-4">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Tournament Title</label>
                <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
            </div>
            <div class="mb-4">
                <label for="max_teams" class="block text-sm font-medium text-gray-700">Max Teams</label>
                <input type="number" name="max_teams" id="max_teams" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
            </div>
            <button type="submit" class="mt-2 bg-green-700 text-white px-4 py-2 rounded">Create Tournament</button>
        </form>
    </div>
</x-base-layout>
