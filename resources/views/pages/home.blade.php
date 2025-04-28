<x-app>
    <header class="max-w-7xl mx-auto p-8 bg-white">
        <!-- Top Centered Navigation Text -->
        <div class="text-center px-6 pb-6">
            <nav class="space-x-3 lg:space-x-10 text-sm font-semibold text-gray-600">
                <a href="/" class="hover:text-lime-800">Home</a>
                <a href="#products" class="hover:text-lime-800">Products</a>
                <a href="/help" class="hover:text-lime-800">Help Center</a>
                <a href="#" class="hover:text-lime-800">Offers</a>
            </nav>
        </div>

        <!-- Hero Section -->
        <div class="container p-6 mx-auto bg-lime-100 rounded-lg shadow-md">
            <div class="items-center lg:flex">
                <div class="w-full lg:w-1/2 lg:px-6">
                    <div class="lg:max-w-lg">
                        <h1 class="text-3xl font-semibold text-gray-800 lg:text-4xl">
                            Best place to choose <br />
                            your <span class="text-lime-500">gadgets</span>
                        </h1>
                        <p class="mt-3 text-gray-600">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro
                            beatae error laborum ab amet sunt recusandae? Reiciendis natus
                            perspiciatis optio.
                        </p>
                        <button href='#'
                            class="w-full px-5 py-2 mt-6 text-sm tracking-wider text-white uppercase transition-colors duration-300 transform bg-lime-700 rounded-lg lg:w-auto hover:bg-lime-800 focus:outline-none focus:bg-lime-800">
                            Shop Now
                        </button>
                    </div>
                </div>
                <div class="flex items-center justify-center w-full mt-6 lg:mt-0 lg:w-1/2">
                    <img class="w-full h-full lg:max-w-3xl" src="images/hero.png" alt="Hero" />
                </div>
            </div>
        </div>
    </header>

    <section id="products">
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
            <header>
                <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">Product Collection</h2>
                <p class="mt-4 max-w-md text-gray-500">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque praesentium cumque iure
                    dicta incidunt est ipsam, officia dolor fugit natus?
                </p>
            </header>

            <div x-data="{ open: false }" class="mt-8 block lg:hidden">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium text-left text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100">
                    Sort by Category
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform transition-transform"
                        :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" class="mt-2 bg-white rounded-md shadow-md overflow-hidden border border-gray-200">
                    <ul class="divide-y divide-gray-100">
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Laptops</li>
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Smartphones & Gadgets</li>
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Keyboards</li>
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Mouse Devices</li>
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Headphones</li>
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Monitors</li>
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Chargers & Adapters</li>
                    </ul>
                </div>
            </div>

            <div class="mt-4 lg:mt-8 lg:grid lg:grid-cols-4 lg:items-start lg:gap-8">
                <div class="hidden lg:block w-full p-4 bg-white rounded-lg shadow-md">
                    <h2 class="text-sm font-semibold text-gray-700 mb-4">CATEGORY</h2>
                    <div class="my-4 border-t border-gray-200"></div>
                    <ul class="space-y-3">
                        <li
                            class="flex items-center justify-between text-sm text-gray-700 hover:text-lime-800 cursor-pointer">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 6h18M3 6v10h18V6M4 16h16a1 1 0 011 1v1H3v-1a1 1 0 011-1z" />
                                </svg>
                                Laptops
                            </div>
                            <span class="text-lg">+</span>
                        </li>
                        <li
                            class="flex items-center justify-between text-sm text-gray-700 hover:text-lime-800 cursor-pointer">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                </svg>
                                Smartphones & Gadgets
                            </div>
                            <span class="text-lg">+</span>
                        </li>
                        <li
                            class="flex items-center justify-between text-sm text-gray-700 hover:text-lime-800 cursor-pointer">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 6h18M3 6v12h18V6M4 10h2M8 10h2M12 10h2M16 10h2M4 14h16" />
                                </svg>
                                Keyboards
                            </div>
                            <span class="text-lg">+</span>
                        </li>
                        <li
                            class="flex items-center justify-between text-sm text-gray-700 hover:text-lime-800 cursor-pointer">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 2v6m0 0H8a4 4 0 00-4 4v4a4 4 0 004 4h8a4 4 0 004-4v-4a4 4 0 00-4-4h-4z" />
                                </svg>
                                Mouse Devices
                            </div>
                            <span class="text-lg">+</span>
                        </li>
                        <li
                            class="flex items-center justify-between text-sm text-gray-700 hover:text-lime-800 cursor-pointer">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 12v2a4 4 0 004 4v-4a4 4 0 00-4-4zm16 0v2a4 4 0 01-4 4v-4a4 4 0 014-4zM12 4a8 8 0 00-8 8v0a8 8 0 0016 0v0a8 8 0 00-8-8z" />
                                </svg>
                                Headphones
                            </div>
                            <span class="text-lg">+</span>
                        </li>
                        <li
                            class="flex items-center justify-between text-sm text-gray-700 hover:text-lime-800 cursor-pointer">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 5h16v10H4zM12 15v2m-4 2h8" />
                                </svg>
                                Monitors
                            </div>
                            <span class="text-lg">+</span>
                        </li>
                        <li
                            class="flex items-center justify-between text-sm text-gray-700 hover:text-lime-800 cursor-pointer">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Chargers & Adapters
                            </div>
                            <span class="text-lg">+</span>
                        </li>
                    </ul>
                </div>

                <div class="lg:col-span-3">

                    <x-product :products="$products" />

                </div>
            </div>
        </div>
    </section>
</x-app>

<script>
    @if (session('clear_cart'))
        localStorage.removeItem('cart');
    @endif
</script>

<!-- Scripts -->
<script src="//unpkg.com/alpinejs" defer></script>
