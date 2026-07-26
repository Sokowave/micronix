<?php

namespace App\Livewire\Frontend\Products;

use App\Models\Product;
use App\Services\Frontend\Breadcrumb;
use App\Services\Frontend\Product\FindBySlug;
use App\Services\Frontend\Product\Related;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.frontend')]
class Show extends Component
{
    public Product $product;

    public function mount(
        string $slug,
        FindBySlug $findBySlug,
    ): void {
        $this->product = $findBySlug->get($slug);
    }

    public function render(
        Related $related,
        Breadcrumb $breadcrumb,
    ): View {
        return view('livewire.frontend.products.show', [
            'breadcrumbs' => $breadcrumb->category(
                $this->product->category
            ),

            'relatedProducts' => $related->get(
                $this->product
            ),
        ]);
    }
}