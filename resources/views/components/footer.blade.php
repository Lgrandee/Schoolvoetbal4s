<footer class="bg-[#065f46] text-orange-100 py-10">
    <div class="container mx-auto flex flex-col items-center">
        <div class="flex items-center mb-4">
            <img src="{{ asset('img/Logo_img.png') }}" alt="Logo" class="h-10 w-auto mr-2">
            <span class="text-xl font-bold">Football Tournament</span>
        </div>

        <!-- Quick Links -->
        <div>
            <h2 class="text-xl font-bold">Snelkoppelingen</h2>
            <ul class="mt-2">
                <li class="mt-2"><a href="{{ route('home') }}" class="relative text-lg font-semibold w-fit block after:block after:content-[''] after:absolute after:h-[3px] after:bg-[#91BA8D] after:w-full after:scale-x-0 after:hover:scale-x-100 after:transition after:duration-300 after:origin-right">Home</a></li>
                <li class="mt-2"><a href="{{ route('creatteam') }}" class="relative text-lg font-semibold w-fit block after:block after:content-[''] after:absolute after:h-[3px] after:bg-[#91BA8D] after:w-full after:scale-x-0 after:hover:scale-x-100 after:transition after:duration-300 after:origin-right">Over ons</a></li>
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
</footer>
