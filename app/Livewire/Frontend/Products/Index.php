<?php

namespace App\Livewire\Frontend\Products;

use App\Models\Category;
use App\Services\Frontend\Brand as BrandService;
use App\Services\Frontend\Breadcrumb;
use App\Services\Frontend\Category as CategoryService;
use App\Services\Frontend\Product\Filters;
use App\Services\Frontend\Product\Index as ProductIndex;
use App\Services\Frontend\Product\Pagination;
use App\Services\Frontend\Search;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.frontend')]
class Index extends Component
{
    use WithPagination;

    public ?Category $category = null;

    #[Url(as: 'q', except: '')]
    public string $search = '';

    #[Url(as: 'sort', except: 'featured')]
    public string $sort = 'featured';

    #[Url(as: 'brand')]
    public array $brands = [];

    public string $brandSearch = '';

    #[Url(as: 'condition')]
    public array $conditions = [];

    #[Url(as: 'in_stock', except: false)]
    public bool $inStock = false;

    #[Url(as: 'min_price')]
    public ?int $minPrice = null;

    #[Url(as: 'max_price')]
    public ?int $maxPrice = null;

    public function mount(?Category $category = null): void
    {
        $this->category = $category;
    }

    public function updated(string $property): void
    {
        if (
            $property === 'search' ||
            str_starts_with($property, 'brands') ||
            str_starts_with($property, 'conditions') ||
            in_array($property, [
                'inStock',
                'minPrice',
                'maxPrice',
                'sort',
            ], true)
        ) {
            $this->resetPage();
        }
    }

    public function removeBrand(string $brand): void
    {
        $this->brands = array_values(
            array_filter(
                $this->brands,
                fn (string $item) => $item !== $brand
            )
        );

        $this->resetPage();
    }

    public function removeCondition(string $condition): void
    {
        $this->conditions = array_values(
            array_filter(
                $this->conditions,
                fn (string $item) => $item !== $condition
            )
        );

        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->reset([
            'brands',
            'conditions',
            'inStock',
            'minPrice',
            'maxPrice',
        ]);

        $this->resetPage();
    }

    public function setPriceRange(?int $min, ?int $max): void
    {
        $this->minPrice = $min;
        $this->maxPrice = $max;

        $this->resetPage();
    }

    public function render(
        ProductIndex $products,
        Search $search,
        Filters $filters,
        Pagination $pagination,
        CategoryService $categories,
        BrandService $brandService,
        Breadcrumb $breadcrumb,
    ): View {
        $categoryIds = $this->category
            ? $categories->idsWithDescendants($this->category)
            : [];

        $query = $products->query($categoryIds);

        if ($this->search !== '') {
            $query = $search->apply($query, $this->search);
        }

        $query = $filters->apply($query, [
            'brands' => $this->brands,
            'conditions' => $this->conditions,
            'in_stock' => $this->inStock,
            'min_price' => $this->minPrice,
            'max_price' => $this->maxPrice,
        ]);

        return view('livewire.frontend.products.index', [
            'products' => $pagination->paginate(
                query: $query,
                sort: $this->sort,
                perPage: 24,
            ),

            'filterBrands' => $brandService->filters(
                $this->brandSearch
            ),

            'categories' => $categories->navigation(
                $this->category
            ),

            'category' => $this->category,

            'breadcrumbs' => $breadcrumb->category(
                $this->category
            ),
        ]);
    }
}