<x-base-layout>
    <div class="text-center">
        @auth
            @if(Auth::user()->is_admin)
                <p class="mt-4 text-2xl font-bold rainbow">Hello, {{ Auth::user()->name }}! You have access to additional content.</p>
            @endif
        @endauth
    </div>

    <div class="grid grid-cols-3 gap-4 p-6">
        <div class="col-span-1">
            <h2 class="text-xl font-bold">Top 5:</h2>
            <ol class="list-decimal pl-5">
                @foreach($topTeams as $team)
                    <li>{{ $team->name }} - {{ $team->points }} points</li>
                @endforeach
            </ol>
        </div>

        <div class="col-span-2">
            <h2 class="text-xl font-bold">Naar het wedstrijdschema</h2>
            <div class="border-2 border-dashed h-48 flex items-center justify-center">
                <p class="text-center">Hier komt de afbeelding</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4 p-6">
        <div class="col-span-1">
            <h2 class="text-xl font-bold">Mijn Team:</h2>
            <div class="border-2 border-dashed h-48">
                <p class="text-center">Team details here</p>
            </div>
        </div>
    </div>
</x-base-layout>
