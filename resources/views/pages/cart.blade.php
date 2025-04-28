    <x-app>
        <div class="max-w-5xl max-md:max-w-xl mx-auto p-4">
            <h1 class="text-2xl font-bold text-slate-900">Your Cart</h1>
            <div class="grid md:grid-cols-3 gap-10 mt-8">
                <div class="md:col-span-2 space-y-4 overflow-y-auto h-dvh" id="cartItemsContainer"></div>

                <form action="/checkout" method="post" id="checkoutForm">
                    @csrf
                    <div class="bg-white rounded-md px-4 py-6 h-max shadow-[0_2px_12px_-3px_rgba(61,63,68,0.3)]">
                        <ul class="text-slate-900 font-medium space-y-4 overflow-y-auto">
                            <li class="flex flex-wrap gap-4 text-sm">
                                Subtotal <span id="subtotal" class="ml-auto font-semibold">₱0.00</span>
                            </li>
                            <li class="flex flex-wrap gap-4 text-sm">
                                Shipping <span id="shipping" class="ml-auto font-semibold">₱0.00</span>
                            </li>
                            <li class="flex flex-wrap gap-4 text-sm">
                                Tax <span id="tax" class="ml-auto font-semibold">₱0.00</span>
                            </li>
                            <hr class="border-slate-300" />
                            <li class="flex flex-wrap gap-4 text-sm font-semibold">
                                Total <span id="total" class="ml-auto">₱0.00</span>
                            </li>
                        </ul>

                        <input type="hidden" name="cart_items" id="cartItemsInput">
                        <input type="hidden" name="subtotal" id="subtotalInput">
                        <input type="hidden" name="shipping" id="shippingInput">
                        <input type="hidden" name="tax" id="taxInput">
                        <input type="hidden" name="total" id="totalInput">

                        <div class="mt-8 space-y-2">
                            @auth
                                <button type="submit" id="buyNowButton"
                                    class="text-sm px-4 py-2.5 w-full font-semibold tracking-wide bg-slate-800 hover:bg-slate-900 text-white rounded-md">
                                    Buy Now
                                </button>
                            @else
                                <button type="button" id="buyNowButton" onclick="window.location.href='/signin';"
                                    class="text-sm px-4 py-2.5 w-full font-semibold tracking-wide bg-slate-800 hover:bg-slate-900 text-white rounded-md">
                                    Login to Checkout
                                </button>
                            @endauth

                            <button type="button" onclick="window.location.href='/#products';"
                                class="text-sm px-4 py-2.5 w-full font-semibold tracking-wide bg-transparent hover:bg-slate-100 text-slate-900 border border-slate-300 rounded-md">
                                Continue Shopping
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function renderCartItems() {
                const cart = JSON.parse(localStorage.getItem('cart')) || [];
                const container = document.getElementById('cartItemsContainer');
                const buyNowButton = document.getElementById('buyNowButton');
                container.innerHTML = '';

                if (cart.length === 0) {
                    container.innerHTML =
                        `<p class="text-center text-lg text-slate-500">Your cart is empty!</p>`;
                    buyNowButton.disabled = true;
                    return;
                }

                buyNowButton.disabled = false;

                cart.forEach(item => {
                    const itemHTML = `
                        <div class="flex gap-4 bg-white px-4 py-6 rounded-md shadow-[0_2px_12px_-3px_rgba(61,63,68,0.3)]">
                            <div class="flex gap-4">
                                <div class="w-28 h-28 max-sm:w-24 max-sm:h-24 shrink-0">
                                    <img src='{{ asset('${item.image_url}') }}' class="w-full h-full object-contain" />
                                </div>

                                <div class="flex flex-col gap-4">
                                    <div>
                                        <h3 class="text-sm sm:text-base font-semibold text-slate-900">${item.name}</h3>
                                        <p class="text-sm font-semibold text-slate-500 mt-2">Stock: ${item.stock}</p>
                                    </div>

                                    <div class="mt-auto flex items-center gap-3">
                                        <button onclick="updateQuantity('${item.id}', 'decrease')" type="button"
                                            class="flex items-center justify-center w-5 h-5 bg-slate-400 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-2 fill-white"
                                                viewBox="0 0 124 124"><path d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z"/></svg>
                                        </button>
                                        <span class="font-semibold text-sm leading-[18px]">${item.quantity}</span>
                                        <button onclick="updateQuantity('${item.id}', 'increase')" type="button"
                                            class="flex items-center justify-center w-5 h-5 bg-slate-800 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-2 fill-white" viewBox="0 0 42 42"><path d="M37.059 16H26V4.941C26 2.224 23.718 0 21 0s-5 2.224-5 4.941V16H4.941C2.224 16 0 18.282 0 21s2.224 5 4.941 5H16v11.059C16 39.776 18.282 42 21 42s5-2.224 5-4.941V26h11.059C39.776 26 42 23.718 42 21s-2.224-5-4.941-5z"/></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-auto flex flex-col justify-between items-end">
                                <svg onclick="removeItem('${item.id}')" xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4 cursor-pointer fill-slate-400 hover:fill-red-600"
                                    viewBox="0 0 24 24">
                                    <path d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2Z"/>
                                    <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z"/>
                                </svg>
                                <h3 class="text-sm sm:text-base font-semibold text-slate-900 mt-2">₱${(item.price * item.quantity).toFixed(2)}</h3>
                            </div>
                        </div>
                    `;
                    container.innerHTML += itemHTML;
                });

                updateSummary();
            }

            function updateQuantity(id, action) {
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                const product = cart.find(p => p.id === id);

                if (!product) return;

                if (action === 'increase' && product.quantity < product.stock) {
                    product.quantity++;
                } else if (action === 'decrease') {
                    product.quantity--;
                    if (product.quantity <= 0) {
                        cart = cart.filter(p => p.id !== id);
                    }
                }

                localStorage.setItem('cart', JSON.stringify(cart));
                renderCartItems();
            }

            function removeItem(id) {
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                cart = cart.filter(item => item.id !== id);
                localStorage.setItem('cart', JSON.stringify(cart));
                renderCartItems();
            }

            function updateSummary() {
                const cart = JSON.parse(localStorage.getItem('cart')) || [];

                let subtotal = 0;
                cart.forEach(item => {
                    subtotal += item.price * item.quantity;
                });

                const shipping = subtotal > 0 ? 2.00 : 0.00;
                const tax = subtotal * 0.02;
                const total = subtotal + shipping + tax;

                // Update HTML
                document.getElementById('subtotal').innerText = `₱${subtotal.toFixed(2)}`;
                document.getElementById('shipping').innerText = `₱${shipping.toFixed(2)}`;
                document.getElementById('tax').innerText = `₱${tax.toFixed(2)}`;
                document.getElementById('total').innerText = `₱${total.toFixed(2)}`;

                // Update hidden inputs for form submission
                document.getElementById('cartItemsInput').value = JSON.stringify(cart);
                document.getElementById('subtotalInput').value = subtotal.toFixed(2);
                document.getElementById('shippingInput').value = shipping.toFixed(2);
                document.getElementById('taxInput').value = tax.toFixed(2);
                document.getElementById('totalInput').value = total.toFixed(2);
            }

            document.addEventListener('DOMContentLoaded', () => {
                renderCartItems();
                updateSummary();
            });

            document.getElementById('checkoutForm')?.addEventListener('submit', (e) => {
                updateSummary();
            });
        </script>
    </x-app>
