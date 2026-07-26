<?php

namespace App\Livewire\Frontend\Header;

use App\Services\Frontend\Product\Index as ProductIndex;
use App\Services\Frontend\Search as SearchService;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Search extends Component
{
    public string $q = '';

    public int $activeIndex = -1;

    public function updatedQ(): void
    {
        $this->activeIndex = -1;
    }

    public function moveDown(int $count): void
    {
        if ($count === 0) {
            return;
        }

        $this->activeIndex = min(
            $this->activeIndex + 1,
            $count - 1
        );
    }

    public function moveUp(int $count): void
    {
        if ($count === 0) {
            return;
        }

        $this->activeIndex = max(
            $this->activeIndex - 1,
            0
        );
    }

    public function resetActive(): void
    {
        $this->activeIndex = -1;
    }

    public function render(
        SearchService $search,
        ProductIndex $products,
    ): View {
        $suggestions = [
            'tags' => collect(),
            'categories' => collect(),
            'products' => collect(),
        ];

        if (mb_strlen(trim($this->q)) >= 2) {
            $suggestions = $search->suggestions(
                $products,
                $this->q
            );
        }

        return view('livewire.frontend.header.search', [
            'suggestions' => $suggestions,
        ]);
    }
}