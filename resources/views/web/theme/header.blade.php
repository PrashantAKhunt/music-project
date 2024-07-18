<header class="bg-blue-600 text-white p-4 flex justify-between items-center">
    <a href="{{ route('home') }}" class="text-2xl font-bold">
        <img src="{{ asset('images/sjGadhviLogo.jpg') }}" alt="logo" class="h-10 w-10 rounded-full inline-block">
        SJ Gadhvi
    </a>
    <nav>
        <ul class="hidden md:flex space-x-4">
            <li><a href="{{ route('home') }}" class="hover:underline">Home</a></li>
            <li><a href="{{ route('videos.index') }}" class="hover:underline">Videos</a></li>
            {{-- <li><a href="{{ route('blogs') }}" class="hover:underline">Lyrics</a></li> --}}
            {{-- <li><a href="{{ route('about-us') }}" class="hover:underline">About Us</a></li> --}}
        </ul>
        <button id="menuButton" class="md:hidden focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
    </nav>
</header>
<div id="mobileMenu" class="hidden md:hidden bg-blue-600 text-white p-4">
    <ul class="space-y-2">
        <li><a href="{{ route('home') }}" class="block hover:underline">Home</a></li>
        <li><a href="{{ route('videos.index') }}" class="block hover:underline">Videos</a></li>
        {{-- <li><a href="{{ route('blogs') }}" class="block hover:underline">Lyrics</a></li> --}}
        {{-- <li><a href="{{ route('about-us') }}" class="block hover:underline">About Us</a></li> --}}
    </ul>
</div>
