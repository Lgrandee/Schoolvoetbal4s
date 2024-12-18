<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/schoolvoetbal.js'])
    <title>Football Tournament</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1; /* This allows the main content to grow and take available space */
        }
    </style>
</head>
<body>
    <header>
        <x-header />
    </header>

    <main>
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            {{$slot}}
        </div>
    </main>

    <footer>
        <x-footer />
    </footer>
</body>
</html>
