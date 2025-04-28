<ul class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
    @foreach ($products as $product)
        <li>
            <a href="{{ url('/products/' . $product->id) }}" class="group block overflow-hidden">
                <img src="{{ asset($product->image_url) }}" alt="Product Image"
                    class="h-[350px] w-full object-cover transition duration-500 group-hover:scale-105 sm:h-[450px]" />
                <div class="relative bg-white pt-3">
                    <h3 class="text-xs text-gray-700 group-hover:underline group-hover:underline-offset-4">
                        {{ $product->name }}
                    </h3>
                    <p class="mt-2">
                        <span class="sr-only"> Regular Price </span>
                        <span class="tracking-wider text-gray-900">₱{{ $product->price }}.00</span>
                    </p>
                </div>
            </a>
        </li>
    @endforeach
</ul>

<ol class="mt-8 flex justify-center gap-1 text-xs font-medium">

    @if ($products->onFirstPage())
        <li>
            <span
                class="inline-flex size-8 items-center justify-center rounded-sm border border-gray-100 opacity-50 cursor-not-allowed">
                <span class="sr-only">Prev Page</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </li>
    @else
        <li>
            <a href="{{ $products->previousPageUrl() }}"
                class="inline-flex size-8 items-center justify-center rounded-sm border border-gray-100">
                <span class="sr-only">Prev Page</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        </li>
    @endif

    @for ($i = 1; $i <= $products->lastPage(); $i++)
        <li>
            <a href="{{ $products->url($i) }}"
                class="block size-8 rounded-sm border {{ $products->currentPage() == $i ? 'border-black bg-black text-white' : 'border-gray-100 text-gray-900' }} text-center leading-8">
                {{ $i }}
            </a>
        </li>
    @endfor

    @if ($products->hasMorePages())
        <li>
            <a href="{{ $products->nextPageUrl() }}"
                class="inline-flex size-8 items-center justify-center rounded-sm border border-gray-100">
                <span class="sr-only">Next Page</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        </li>
    @else
        <li>
            <span
                class="inline-flex size-8 items-center justify-center rounded-sm border border-gray-100 opacity-50 cursor-not-allowed">
                <span class="sr-only">Next Page</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </li>
    @endif
</ol>

<script>
    document.querySelectorAll('a[href*="page="]').forEach(link => {
        link.addEventListener('click', function() {
            sessionStorage.setItem('scrollPosition', window.scrollY);
        });
    });

    window.addEventListener('load', function() {
        const scrollY = sessionStorage.getItem('scrollPosition');
        if (scrollY) {
            window.scrollTo(0, parseInt(scrollY));
            sessionStorage.removeItem('scrollPosition');
        }
    });
</script>
