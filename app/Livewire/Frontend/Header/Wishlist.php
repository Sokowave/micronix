<?php

namespace App\Livewire\Frontend\Header;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Wishlist extends Component
{
    public function render(): View
    {
        return view('livewire.frontend.header.wishlist');
    }
}