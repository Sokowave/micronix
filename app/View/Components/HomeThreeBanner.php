<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Banner;

class HomeThreeBanner extends Component
{
    public $banners;

    public function __construct()
    {
        $this->banners = Banner::where('type', 'home_three_banner')
            ->where('status', true)
            ->latest('id')
            ->take(3)
            ->get();
    }

    public function render()
    {
        return view('components.home-three-banner');
    }
}
