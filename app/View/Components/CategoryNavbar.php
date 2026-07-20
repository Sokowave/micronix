<?php

namespace App\View\Components;

use App\Services\CategoryTreeService;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryNavbar extends Component
{
    /**
     * The filtered category tree.
     */
    public $categories;

    /**
     * Create the component instance.
     */
    public function __construct(CategoryTreeService $categoryTree)
    {
        $this->categories = $categoryTree->tree();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.category-navbar');
    }
}