<x-base-layout>

    <h1 class="flex justify-center my-11 grid-rows-1 text-2xl font-bold ">Voeg een nieuw team toe</H1>
    <div class="flex justify-center my-11 grid-rows-1 ">
        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif

        <form action="{{ route('team.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label class="block text-sm font-medium text-gray-700"for="name">Naam:</label>
            <input class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 type="text" id="name" name="name" required><br><br>

            <label class="block text-sm font-medium text-gray-700" for="coach">Coach:</label>
            <input class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 type="text" id="coach" name="coach" required><br><br>

            <label class="block text-sm font-medium text-gray-700" for="team_members">Teamleden:</label>
            <input class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 type="number" id="team_members" name="team_members" required><br><br>

            <label class="block text-sm font-medium text-gray-700" for="logo">Logo:</label>
            <input class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 type="file" id="logo" name="logo"><br><br>

            <button class="mt-2 bg-green-700 text-white px-4 py-2 rounded" type="submit">Team toevoegen</button>
        </form>
    </div>


</x-base-layout>
