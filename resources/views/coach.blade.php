<x-base-layout>
    @auth
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            @if($team)
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
                    <input class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                           type="text" id="name" name="name" value="{{ $team->name }}" required><br><br>

                    <label class="block text-sm font-medium text-gray-700" for="coach">Coach:</label>
                    <input class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                           type="text" id="coach" name="coach" value="{{ auth()->user()->name }}" required><br><br>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Update Team
                    </button>
                </form>
            @else
                <div class="text-red-600">
                    You don't have a team yet.
                </div>
            @endif
        </div>
    @endauth
</x-base-layout>
