
<x-layout>
    <x-slot:title>
        Homepage
    </x-slot>
    <div class="relative flex items-top justify-center min-h-screen bg-dark text-white sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="text-center">
            <h1 class="mb-3">Welcome to Celebrity News</h1>

            <h3 class="mb-5">
                The cool new app to learn and share knowledge about celebrities around the world !
            </h2>
            <p class="">
                You can colaborate to create new celebrity shit, update/modify or delete existing ones.
            </p>

            <a href="/celebrities" class="btn btn-danger d-inline-flex">Go to celebrities list
                <span style="margin-left: 5px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-square-fill" viewBox="0 0 16 16">
                    <path d="M0 14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12zm4.5-6.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5a.5.5 0 0 1 0-1z"/>
                    </svg>
                </span>
            </a>
        </div>
    </div>
</x-layout>
