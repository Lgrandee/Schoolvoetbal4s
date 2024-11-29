<x-base-layout>
    @auth
            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <h1 class="text-2xl font-bold">Add a Team</h1>

                @if(session('success'))
                    <div class="mt-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('coach.store') }}" class="mt-4" enctype="multipart/form-data">
                    @csrf
                    <label class="block text-sm font-medium text-gray-700"for="name">Naam:</label>
                    <input class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" type="text" id="name" name="name" required><br><br>

                    <label class="block text-sm font-medium text-gray-700" for="coach">Coach:</label>
                    <input class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" type="text" id="coach" name="coach" required><br><br>

                    <label class="block text-sm font-medium text-gray-700" for="player_count">Teamleden:</label>
                    <input class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" type="number" id="player_count" name="player_count" required><br><br>

                    <label class="block text-sm font-medium text-gray-700" for="logo">Logo:</label>
                    <input type="file" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" id="logo" name="logo" accept="image/*" required><br><br>

                    <button type="submit" class="mt-2 bg-green-700 text-white px-4 py-2 rounded">Add Team</button>
                </form>
            </div>
    @else
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <h1 class="text-2xl font-bold">Access Denied</h1>
            <p>You must be logged in to view this page.</p>
        </div>
    @endauth
</x-base-layout>
