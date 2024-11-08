<x-base-layout>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <h1 class="text-2xl font-bold">Welcome to Our Application</h1>
        <p class="mt-4">This is the homepage. Please log in or register to access more features.</p>

        @auth
            <p class="mt-4">Hello, {{ Auth::user()->name }}! You have access to additional content.</p>
        @else
            <p class="mt-4">You are currently a guest. Please log in or register to enjoy more features.</p>
            <a href="{{ route('login') }}" class="text-blue-500">Log in</a> or
            <a href="{{ route('register') }}" class="text-blue-500">Register</a>
        @endauth
    </div>
</x-base-layout>
