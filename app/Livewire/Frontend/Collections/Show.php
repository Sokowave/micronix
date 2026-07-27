<?php

namespace App\Livewire\Frontend\Collections;

use App\Models\Collection;
use App\Services\Collection\Show as CollectionShow;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.frontend')]
class Show extends Component
{
    public Collection $collection;

    public function mount(
        string $slug,
        CollectionShow $collections,
    ): void {
        $this->collection = $collections->find($slug);
    }

    public function render(
        CollectionShow $collections,
    ): View {
        return view('livewire.frontend.collections.show', [
            'products' => $collections->products($this->collection),
        ]);
    }
}