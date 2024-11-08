<footer class="bg-[#065f46] text-orange-100 py-10">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Company Info -->
        <div>
            <h2 class="text-xl font-bold rounded-lg">Schoolvoetbal</h2>
            <p class="mt-2 text-orange-100 rounded-lg">
                Dit is waar de echte winnaars ontstaan!
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h2 class="text-xl font-bold">Snelkoppelingen</h2>
            <ul class="mt-2">
                <li class="mt-2"><a href="{{ route('home') }}" class="relative text-lg font-semibold w-fit block after:block after:content-[''] after:absolute after:h-[3px] after:bg-[#91BA8D] after:w-full after:scale-x-0 after:hover:scale-x-100 after:transition after:duration-300 after:origin-right">Home</a></li>
                <li class="mt-2"><a href="{{ route('about') }}" class="relative text-lg font-semibold w-fit block after:block after:content-[''] after:absolute after:h-[3px] after:bg-[#91BA8D] after:w-full after:scale-x-0 after:hover:scale-x-100 after:transition after:duration-300 after:origin-right">Over ons</a></li>
                <li class="mt-2"><a href="{{ route('services') }}" class="relative text-lg font-semibold w-fit block after:block after:content-[''] after:absolute after:h-[3px] after:bg-[#91BA8D] after:w-full after:scale-x-0 after:hover:scale-x-100 after:transition after:duration-300 after:origin-right">Diensten</a></li>
                <li class="mt-2"><a href="{{ route('contact') }}" class="relative text-lg font-semibold w-fit block after:block after:content-[''] after:absolute after:h-[3px] after:bg-[#91BA8D] after:w-full after:scale-x-0 after:hover:scale-x-100 after:transition after:duration-300 after:origin-right">Contact</a></li>
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
