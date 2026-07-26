<?php

namespace App\View\Components\Frontend;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class MegaMenu extends Component
{
    public array $categories;

    public function __construct()
    {
        $this->categories = Cache::rememberForever(
            'frontend.mega-menu.categories',
            fn (): array => Category::query()
                ->whereNull('parent_id')
                ->where('is_active', true)
                ->with([
                    'children' => fn ($query) => $query
                        ->where('is_active', true)
                        ->orderBy('position')
                        ->orderBy('name')
                        ->with([
                            'children' => fn ($query) => $query
                                ->where('is_active', true)
                                ->orderBy('position')
                                ->orderBy('name'),
                        ]),
                ])
                ->orderBy('position')
                ->orderBy('name')
                ->get()
                ->toArray()
        );
    }

    public function render(): View|Closure|string
    {
        return view('components.frontend.mega-menu');
    }
}