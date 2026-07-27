<?php

namespace App\Livewire\Frontend\Products;

use App\Services\Deals\Show as DealShow;
use App\Services\Frontend\Breadcrumb;
use App\Services\Frontend\Product\FindBySlug;
use App\Services\Frontend\Product\Related;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.frontend')]
class Show extends Component
{
    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
    }

    public function render(
        FindBySlug $findBySlug,
        Related $related,
        Breadcrumb $breadcrumb,
        DealShow $deals,
    ): View {
        $product = $findBySlug->get($this->slug);

        return view('livewire.frontend.products.show', [
            'product' => $product,

            'breadcrumbs' => $breadcrumb->category(
                $product->category
            ),

            'deal' => $deals->forProduct($product),

            'relatedProducts' => $related->get($product),
        ]);
    }
}