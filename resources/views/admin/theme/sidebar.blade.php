<div id="sidebar" class="bg-blue-600 text-white w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out">
    <div class="flex items-center space-x-2 px-4">
        <img src="{{ asset('images/sjGadhviLogo.jpg') }}" alt="logo" class="w-10 h-10">
        <h1 class="text-2xl font-semibold">SJ Gadhvi</h1>
    </div>
    <nav>
        <a href="{{ route('admin.dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700">Dashboard</a>
        <a href="{{ route('admin.categories.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700">Categories</a>
        <a href="{{ route('admin.videos.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700">Videos</a>
        {{-- <a href="add-blog.html" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700">Blogs</a> --}}
        {{-- <a href="about.html" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700">About Us</a> --}}
        <!-- Add more links here -->
    </nav>
</div>
