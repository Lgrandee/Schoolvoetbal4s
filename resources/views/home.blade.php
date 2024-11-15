<x-base-layout>
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-orange-100 dark:bg-dots-lighter dark:bg-orange-100 selection:bg-red-500 selection:text-white">
        <div class="text-center">
            <h1 class="text-2xl font-bold">Welcome to Our Application</h1>

            @auth
                @if(Auth::user()->is_admin)
                    <p class="mt-4">Hello, {{ Auth::user()->name }}! You have access to additional content.</p>
                @endif
            @endauth

            <p class="mt-4">You are currently a guest. Please log in or register to access more features.</p>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-4">
        <img src="{{ asset('img/Voetbal_2.jpg') }}" alt="">
        <img src="" alt="">
    </div>
   </x-base-layout>

