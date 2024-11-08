<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/schoolvoetbal.js'])
    <title>Document</title>
</head>
<body>
<header>
    <x-header />
</header>





    <main>
    {{$slot}}
    </main>
</body>
<footer>
 <x-footer />
</footer>

</html>
