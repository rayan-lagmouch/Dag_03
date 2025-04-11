<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Tier Reservation</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 font-sans">
<div class="min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-600 text-white p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold">My Dashboard</a>
            <div class="flex space-x-4">
                <!-- Add any additional nav links here -->
                <a href="{{ route('profile.edit') }}" class="hover:text-gray-300">Profile</a>
                <a href="{{ route('reservations.index') }}" class="hover:text-gray-300">Reservations</a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="container mx-auto p-8">
        @yield('content')
    </main>
</div>
</body>
</html>
