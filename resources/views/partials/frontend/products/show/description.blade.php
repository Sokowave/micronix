{{-- resources/views/partials/frontend/products/show/description.blade.php --}}

<section
    id="product-description"
    class="scroll-mt-24"
>
    {{-- ========================================================= --}}
    {{-- Section Header                                            --}}
    {{-- ========================================================= --}}

    <div class="mb-5">
        <h2 class="text-xl font-bold tracking-tight text-zinc-950">
            Product Description
        </h2>

        <p class="mt-1 text-sm text-zinc-500">
            Everything you need to know about this product.
        </p>
    </div>

    {{-- ========================================================= --}}
    {{-- Description                                               --}}
    {{-- ========================================================= --}}

    <div
        class="
            overflow-hidden rounded-xl
            border border-zinc-200
            bg-white
        "
    >
        <div class="p-5 sm:p-6 lg:p-7">

            <div
                class="
                    prose prose-zinc
                    max-w-none
                    prose-headings:font-semibold
                    prose-headings:tracking-tight
                    prose-headings:text-zinc-900

                    prose-h2:mt-8
                    prose-h2:text-lg
                    prose-h3:mt-6
                    prose-h3:text-base

                    prose-p:text-sm
                    prose-p:leading-7
                    prose-p:text-zinc-600

                    prose-a:font-medium
                    prose-a:text-micronix-600
                    prose-a:no-underline
                    hover:prose-a:text-micronix-700
                    hover:prose-a:underline

                    prose-strong:font-semibold
                    prose-strong:text-zinc-800

                    prose-li:text-sm
                    prose-li:leading-6
                    prose-li:text-zinc-600

                    prose-ul:my-4
                    prose-ol:my-4

                    prose-img:rounded-xl
                    prose-img:border
                    prose-img:border-zinc-200
                "
            >
                {!! $product->description !!}
            </div>

        </div>
    </div>

</section>