<x-app>
    <div class="bg-white">
        <div class="pt-6">
            <!-- Image gallery -->
            <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-6xl lg:grid-cols-3 lg:gap-x-2 lg:px-8">
                <img src=" {{ asset('images/product_horizontal1.png') }}"
                    alt="Two each of gray, white, and black shirts laying flat."
                    class="hidden size-full rounded-lg object-cover lg:block">
                <div class="hidden lg:grid lg:grid-cols-1 lg:gap-y-8">
                    <img src=" {{ asset('images/product_vertical1.png') }}" alt="Model wearing plain black basic tee."
                        class="aspect-3/2 w-full rounded-lg object-cover">
                    <img src=" {{ asset('images/product_vertical2.png') }}" alt="Model wearing plain gray basic tee."
                        class="aspect-3/2 w-full rounded-lg object-cover">
                </div>
                <img src=" {{ asset('images/product_horizontal2.png') }}" alt="Model wearing plain white basic tee."
                    class="aspect-4/5 size-full object-cover sm:rounded-lg lg:aspect-auto">
            </div>

            <!-- Product info -->
            <div
                class="mx-auto max-w-2xl px-4 pt-10 pb-16 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto_auto_1fr] lg:gap-x-8 lg:px-8 lg:pt-16 lg:pb-24">
                <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">{{ $product->name }}</h1>
                </div>

                <!-- Options -->
                <div class="mt-4 lg:row-span-3 lg:mt-0">
                    <h2 class="sr-only">Product information</h2>
                    <p class="text-3xl tracking-tight text-gray-900">₱{{ $product->price }}.00</p>

                    <form id="addToCartForm" class="mt-8">

                        {{-- Add Current Stocks --}}
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <p class="text-md text-gray-600">Current stock:</p>
                                <p class="text-lg font-medium text-gray-900">{{ $product->stocks }}</p>
                            </div>
                            <div class="flex items-center gap-4">
                                <p class="text-md text-gray-600">Category:</p>
                                <p class="text-lg font-medium text-gray-900">{{ $product->category }}</p>
                            </div>
                        </div>

                        @if ($product->stocks > 0)
                            <button type="button" onclick="addToCart()"
                                class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-lime-700 hover:bg-lime-800 px-8 py-3 text-base font-medium text-white">
                                Add to cart
                            </button>
                        @else
                            <button type="button" disabled
                                class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-gray-400 cursor-not-allowed px-8 py-3 text-base font-medium text-white">
                                Out of Stock
                            </button>
                        @endif

                        <a href="/#products" type="button"
                            class="mt-4 flex w-full items-center justify-center rounded-md border border-transparent bg-gray-400 px-8 py-3 text-base font-medium text-gray-800">
                            Continue shopping
                        </a>


                    </form>
                </div>

                <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pt-6 lg:pr-8 lg:pb-16">
                    <h3 class="sr-only">Description</h3>
                    <div class="space-y-6">
                        <p class="text-base text-gray-900">{{ $product->details }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>

<script>
    function addToCart() {
        const product = {
            id: @json($product->_id),
            name: @json($product->name),
            price: {{ $product->price }},
            stock: {{ $product->stocks }},
            image_url: @json($product->image_url),
            quantity: 1,
        };

        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        const existing = cart.find(item => item.id === product.id);
        if (!existing) {
            cart.push(product);
        } else {
            if (existing.quantity < existing.stock) {
                existing.quantity++;
            } else {
                alert('Maximum stock reached!');
                return;
            }
        }

        localStorage.setItem('cart', JSON.stringify(cart));

        alert(`${product.name} added to cart!`);
    }
</script>
