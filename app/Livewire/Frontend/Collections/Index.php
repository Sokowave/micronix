<?php

namespace App\Livewire\Frontend\Collections;

use App\Services\Collection\Index as CollectionIndex;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.frontend')]
#[Title('Shop by Use Case | Micronix')]
class Index extends Component
{
    public function render(
        CollectionIndex $collections,
    ): View {
        return view('livewire.frontend.collections.index', [
            'collections' => $collections->get(),
        ]);
    }
}