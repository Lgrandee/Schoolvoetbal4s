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
        {{$slot}}
    </main>

    <footer>
        <x-footer />
    </footer>
</body>
</html>
