<!-- Navbar -->
<nav class="sticky top-0 z-50 bg-white border-b border-gray-200">
    <div class="max-w-screen-xl mx-auto px-4 py-3 flex flex-wrap items-center justify-between">
        <!-- Logo -->
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('images/logo.png') }}" class="h-10" alt="SmartSolutions Logo" />
            <span class="text-2xl font-semibold text-black">CHL </span>
            <span class="hidden lg:block text-2xl font-semibold text-black">SmartSolutions</span>
        </a>

        <!-- Desktop Search -->
        <div class="hidden md:block md:flex-1 mx-4">
            <div class="relative max-w-md mx-auto">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" placeholder="Search..."
                    class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-lime-300 focus:border-lime-400" />
            </div>
        </div>

        <!-- Icons -->
        <div class="flex items-center space-x-6 lg:space-x-8 flex-shrink-0 relative z-20">
            <!-- Cart Button -->
            <a href="/cart" class="relative text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-7 h-7">
                    <path
                        d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                </svg>
            </a>

            <!-- Profile Button + Menu -->
            <div class="relative">
                @auth
                    <button id="profile-button" type="button"
                        class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-lime-300">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full" src="{{ asset('images/profile.jpg') }}" alt="user photo" />
                    </button>
                @else
                    <a href="/signin"
                        class="text-white bg-lime-700 hover:bg-lime-800  focus:outline-none focus:ring focus:ring-lime-300 focus:ring-opacity-50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                        SIGN IN
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                @endauth

                <!-- Profile Dropdown -->
                <div id="profile-menu"
                    class="hidden absolute right-0 mt-2 w-56 text-sm text-gray-500 bg-white border border-gray-200 rounded-lg shadow-md">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <span class="block text-sm font-medium text-gray-900">
                            {{ auth()->check() ? auth()->user()->name : 'name name' }}
                        </span>

                        <span
                            class="block text-sm text-gray-500 truncate">{{ auth()->check() ? auth()->user()->email : 'email@gmail.com' }}</span>
                    </div>
                    <ul class="py-2">
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 text-gray-700">Account</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 text-gray-700">Settings</a></li>
                        <!-- Sign out form -->
                        <li>
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="block px-4 py-2 hover:bg-gray-100 text-gray-700">Sign out</a>
                            <!-- Sign out form -->
                            <form id="logout-form" action="{{ route('signout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Search -->
    <div class="block md:hidden px-4 pb-4">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="text" placeholder="Search..."
                class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-lime-300 focus:border-lime-400" />
        </div>
    </div>
</nav>

<!-- Profile Dropdown Toggle Script -->
<script>
    const profileBtn = document.getElementById("profile-button");
    const profileMenu = document.getElementById("profile-menu");

    if (profileBtn && profileMenu) {
        profileBtn.addEventListener("click", () => {
            profileMenu.classList.toggle("hidden");
        });

        window.addEventListener("click", (e) => {
            if (!profileBtn.contains(e.target) && !profileMenu.contains(e.target)) {
                profileMenu.classList.add("hidden");
            }
        });
    }
</script>
