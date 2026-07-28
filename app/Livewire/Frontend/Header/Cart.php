<?php

namespace App\Livewire\Frontend\Header;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Cart extends Component
{
    public function render(): View
    {
        return view('livewire.frontend.header.cart');
    }
}