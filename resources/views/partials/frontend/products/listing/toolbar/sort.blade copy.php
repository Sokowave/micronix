{{-- resources/views/partials/frontend/products/listing/toolbar/sort.blade.php --}}

{{-- Sort Label --}}
<span class="hidden text-xs text-zinc-500 sm:inline">
    Sort by:
</span>

{{-- Sort --}}
<div class="w-[145px] sm:w-[170px]">
    <flux:select
        wire:model.live="sort"
        size="sm"
        aria-label="Sort products"
    >
        <flux:select.option value="featured">
            Featured
        </flux:select.option>

        <flux:select.option value="newest">
            Newest
        </flux:select.option>

        <flux:select.option value="price_asc">
            Price: Low to High
        </flux:select.option>

        <flux:select.option value="price_desc">
            Price: High to Low
        </flux:select.option>

        <flux:select.option value="name_asc">
            Name: A–Z
        </flux:select.option>
    </flux:select>
</div>