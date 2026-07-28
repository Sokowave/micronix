<?php

namespace App\Livewire\Frontend\SeoLandingPage;

use App\Models\SeoLandingPage;
use App\Services\Frontend\SeoLandingPage as SeoLandingPageService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.frontend')]
class Show extends Component
{
    use WithPagination;

    public SeoLandingPage $landingPage;

    public function mount(string $slug): void
    {
        $this->landingPage = SeoLandingPage::query()
            ->active()
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function render(SeoLandingPageService $service): View
    {
        return view('livewire.frontend.seo-landing-page.show', [
            'products' => $service
                ->query($this->landingPage)
                ->paginate(20),
        ]);
    }
}