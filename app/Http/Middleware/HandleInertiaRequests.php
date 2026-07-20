<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Data\Auth\AuthenticatedUserData;
use Inertia\Middleware;
use App\Support\Routes;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'auth' => [
                'user' => fn () => $request->user()
                    ? AuthenticatedUserData::fromModel($request->user())
                    : null,
            ],
            'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',

            'settings' => fn () => SiteSetting::allSettings(),

            'flash' => [
            'success' => fn () => session('success'),
            'error' => fn () => session('error'),
            'warning' => fn () => session('warning'),
            'info' => fn () => session('info'),
            ],

            'routes' => Routes::toArray(),

            'filters' => [
                'q' => $request->query('q'),
            ],
        ];

        
    }
}
