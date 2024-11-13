<div class="relative group">
    <div class="flex items-center space-x-4 p-10 border-b-4 border-gray-200">
        <div id="logo" class="relative cursor-pointer">
            <img src="{{ asset('img/Logo_img.png') }}" alt="Logo" class="h-12 w-12 transition-transform duration-300 ease-in-out group-hover:scale-110 group-hover:opacity-90 sparkle-effect">

            <div id="navLinks" class="absolute left-full top-0 flex space-x-6 opacity-0 translate-x-[-100%] transition-all duration-300 ease-in-out group-hover:opacity-100 group-hover:translate-x-0">
                <a href="{{ route('home') }}" class="text-black text-lg hover:text-[#065f46] transition-transform transform hover:scale-110">Home</a>
                <a href="{{ route('stand') }}" class="text-black text-lg hover:text-[#065f46] transition-transform transform hover:scale-110">Leaderboard</a>
                <a href="{{ route('bracket') }}" class="text-black text-lg hover:text-[#065f46] transition-transform transform hover:scale-110">View the brackets</a>
                @auth
                @if(Auth::user()->is_coach || Auth::user()->is_admin)
                    <a href="{{ route('coach') }}" class="text-black text-lg hover:text-[#065f46] transition-transform transform hover:scale-110">Add your team to the tournament</a>
                @endif
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin') }}" class="text-black text-lg hover:text-[#065f46] transition-transform transform hover:scale-110">Admin</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-black text-lg hover:text-[#065f46] transition-transform transform hover:scale-110">Log Out</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-black text-lg hover:text-[#065f46] transition-transform transform hover:scale-110">Log in</a>
                <a href="{{ route('register') }}" class="text-black text-lg hover:text-[#065f46] transition-transform transform hover:scale-110">Register</a>
            @endauth
            </div>
        </div>

    </div>
</div>


