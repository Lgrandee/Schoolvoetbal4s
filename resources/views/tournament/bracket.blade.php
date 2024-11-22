<x-base-layout>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <h1 class="text-2xl font-bold">{{ $tournament->title }} Bracket</h1>

        <div class="mt-6 grid grid-cols-4 gap-4">
            @foreach($matchups as $matchup)
                <div class="border p-4 rounded">
                    <h3 class="font-semibold">
                        {{ $matchup[0]->name }} vs {{ $matchup[1]->name }}
                    </h3>
                </div>
            @endforeach
        </div>
    </div>
</x-base-layout>
