<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            #sidebar.show {
                transform: translateX(0);
            }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100 flex h-screen">
    <!-- Sidebar -->
    @include('admin.theme.sidebar')

    <!-- Main Content -->
    <div class="flex-1 p-10">
        <button id="menuButton" class="md:hidden mb-4 bg-blue-600 text-white p-2 rounded"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg></button>
        @yield('content')
    </div>
    <script>
        document.getElementById('menuButton').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        });
    </script>
    @stack('scripts')
</body>
</html>
