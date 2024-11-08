<div class="relative group">
    <div class="flex items-center space-x-4 p-4">
        <div id="logo" class="relative cursor-pointer">
            <img src="{{ asset('img/Logo_img.png') }}" alt="Logo" class="h-12 w-12 transition-transform duration-300 ease-in-out group-hover:scale-110 group-hover:opacity-90 sparkle-effect">

            <div id="navLinks" class="absolute left-full top-0 flex space-x-4 opacity-0 translate-x-[-100%] transition-all duration-300 ease-in-out group-hover:opacity-100 group-hover:translate-x-0">
                <a href="{{ route('home') }}" class="text-black text-lg hover:text-[#065f46] transition-transform transform hover:scale-110">Home</a>
                <a href="{{ route('about') }}" class="text-black text-lg hover:text-[#065f46] transition-transform transform hover:scale-110">About</a>
                <a href="{{ route('services') }}" class="text-black text-lg hover:text-[#065f46] transition-transform transform hover:scale-110">Services</a>
                <a href="{{ route('contact') }}" class="text-black text-lg hover:text-[#065f46] transition-transform transform hover:scale-110">Contact</a>
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-black text-lg hover:text-[#065f46] transition-transform transform hover:scale-110">
                            Log Out
                        </button>
                    </form>
                @endauth
            </div>
        </div>

    </div>
</div>


