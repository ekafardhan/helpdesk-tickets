<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-500 to-blue-300 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg p-6 md:p-12 w-full max-w-2xl text-center">
        <img src="{{ asset('img/logo_it_helpdesk.png') }}" alt="Ticket" class="mx-auto w-40 md:w-52 h-auto mb-6">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">
            Selamat Datang di <span class="text-blue-500">Ticket</span>
        </h1>
        <p class="text-gray-600 text-sm md:text-base mb-6">
            Sistem pelaporan yang membantu Anda mengelola Ticket dengan mudah dan efisien, kapan saja, di mana saja.
        </p>
        @if (Route::has('login'))
            <div class="flex justify-center gap-4 flex-wrap">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="bg-blue-500 text-white px-6 py-2 rounded-full shadow-md hover:bg-blue-600 transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="relative inline-block px-8 py-3 font-medium text-blue-600 group">
                        <span
                            class="absolute inset-0 w-full h-full transition-transform duration-300 ease-out transform -translate-x-1 -translate-y-1 bg-blue-500 group-hover:translate-x-0 group-hover:translate-y-0 rounded-full">
                        </span>
                        <span class="absolute inset-0 w-full h-full border-2 border-blue-500 rounded-full"></span>
                        <span class="relative text-white">Log in</span>
                    </a>
                @endauth
            </div>
        @endif
    </div>
</body>

</html>
