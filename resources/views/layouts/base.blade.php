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
    <div class="relative group">
        <div class="flex items-center space-x-4 p-4">
            <div id="logo" class="relative cursor-pointer">
                <img src="{{ asset('img/Logo_img.png') }}" alt="Logo" class="h-12 w-12 transition-transform duration-300 ease-in-out group-hover:scale-110 group-hover:opacity-90 sparkle-effect">

                <div id="navLinks" class="absolute left-full top-0 flex space-x-4 opacity-0 translate-x-[-100%] transition-all duration-300 ease-in-out group-hover:opacity-100 group-hover:translate-x-0">
                    <a href="#" class="text-black text-lg hover:text-[#065f46] transition-transform transform hover:scale-110">Home</a>
                    <a href="#" class="text-black text-lg hover:text-[#065f46] transition-transform transform hover:scale-110">About</a>
                    <a href="#" class="text-black text-lg hover:text-[#065f46] transition-transform transform hover:scale-110">Services</a>
                    <a href="#" class="text-black text-lg hover:text-[#065f46] transition-transform transform hover:scale-110">Contact</a>
                </div>
            </div>
        </div>
    </div>



</header>





    <main>
    {{$slot}}
    </main>
    <footer>

    </footer>
</body>
<footer class="bg-[#065f46] text-orange-100 py-10">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Company Info -->
        <div>
            <h2 class="text-xl font-bold rounded-lg">Weed with lani</h2>
            <p class="mt-2 text-orange-100 rounded-lg">
                feel like u are on Cloud lani
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h2 class="text-xl font-bold">Snelkoppelingen</h2>
            <ul class="mt-2">
                <li class="mt-2"><a href="#" class="relative text-lg font-semibold w-fit block after:block after:content-[''] after:absolute after:h-[3px] after:bg-[#91BA8D] after:w-full after:scale-x-0 after:hover:scale-x-100 after:transition after:duration-300 after:origin-right">Home</a></li>
                <li class="mt-2"><a href="#" class="relative text-lg font-semibold w-fit block after:block after:content-[''] after:absolute after:h-[3px] after:bg-[#91BA8D] after:w-full after:scale-x-0 after:hover:scale-x-100 after:transition after:duration-300 after:origin-right">Over ons</a></li>
                <li class="mt-2"><a href="#" class="relative text-lg font-semibold w-fit block after:block after:content-[''] after:absolute after:h-[3px] after:bg-[#91BA8D] after:w-full after:scale-x-0 after:hover:scale-x-100 after:transition after:duration-300 after:origin-right">Diensten</a></li>
                <li class="mt-2"><a href="#" class="relative text-lg font-semibold w-fit block after:block after:content-[''] after:absolute after:h-[3px] after:bg-[#91BA8D] after:w-full after:scale-x-0 after:hover:scale-x-100 after:transition after:duration-300 after:origin-right">Contact</a></li>
            </ul>
        </div>

        <!-- Social Media Links -->
        <div>
            <h2 class="text-xl font-bold">Volg ons</h2>
            <div class="mt-2 flex space-x-4">
                <a href="#" class="">
                    <img src="https://img.icons8.com/ios-filled/50/ffffff/facebook.png" alt="Facebook" class="h-6 w-6">
                </a>
                <a href="#" class="">
                    <img src="https://img.icons8.com/ios-filled/50/ffffff/twitter.png" alt="Twitter" class="h-6 w-6">
                </a>
                <a href="#" class="">
                    <img src="https://img.icons8.com/ios-filled/50/ffffff/instagram-new.png" alt="Instagram" class="h-6 w-6">
                </a>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="mt-10 text-center text-gray-500">
        &copy; 2024 Bedrijfsnaam. Alle rechten voorbehouden.
    </div>
</footer>
</html>
