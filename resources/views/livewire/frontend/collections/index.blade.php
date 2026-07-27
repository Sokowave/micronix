{{-- resources/views/livewire/frontend/collections/index.blade.php --}}

<div>
    <section class="py-6">
        <div class="mx-auto w-full max-w-7xl px-4 xl:px-6">

            {{-- Header --}}
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-zinc-900">
                    Shop by Use Case
                </h1>

                <p class="mt-1 text-sm text-zinc-500">
                    Find the right technology for work, gaming, study,
                    content creation and more.
                </p>
            </div>

            {{-- Collections --}}
            @if ($collections->isNotEmpty())
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($collections as $collection)
                        <div wire:key="collection-{{ $collection->public_id }}">
                            @include('partials.frontend.collections.card', [
                                'collection' => $collection,
                            ])
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-12 text-center">
                    <p class="text-sm text-zinc-500">
                        No collections are currently available.
                    </p>
                </div>
            @endif

        </div>
    </section>
</div>